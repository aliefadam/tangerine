<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoiceBookingSalon;
use App\Mail\SendReplyFromAdminBookingSalon;
use App\Models\BookingSalon;
use App\Models\ScheduleService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class BookingSalonController extends Controller
{
    public function index()
    {
        $transactions = BookingSalon::select(
            'booking_salons.id',
            'booking_salons.customer_name',
            'services.name as service_name',
            'services.price as service_price',
            'booking_salons.booking_date',
            'schedule_services.session as session',
            'booking_salons.queue_number',
            'booking_salons.created_at',
            'booking_salons.status',
            // 'booking_salons.payment_proof',
            'booking_salons.phone_number',
        )
            ->join('services', 'booking_salons.service_id', '=', 'services.id')
            ->join('schedule_services', 'booking_salons.schedule_id', '=', 'schedule_services.id')
            ->orderBy('booking_salons.created_at', 'desc')
            ->get();

        return view("backend.booking-salon.index", [
            "title" => "Transaction",
            "transactions" => $transactions,
        ]);
    }

    public function storeBooking(Request $request)
    {
        try {
            // Validasi
            $request->validate([
                'service_id' => 'required|exists:services,id',
                'name' => 'required|string|max:255',
                'whatsapp' => 'required|regex:/^\d{10,15}$/',
                // 'payment_proof' => 'required|image|mimes:jpg,jpeg,png',
                'session' => 'required|in:morning,afternoon,evening',
                'date' => 'required|date'
            ]);

            // Cari schedule_id berdasarkan session
            $schedule = ScheduleService::where('session', $request->session)->first();
            if (!$schedule) {
                throw new \Exception("Invalid session selection");
            }

            // Hitung queue_number berdasarkan schedule_id dan booking_date yang sama
            $queueNumber = BookingSalon::where('schedule_id', $schedule->id)
                ->where('booking_date', $request->date)
                ->count() + 1;

            // $file = $request->file("payment_proof");
            // $fileName = "PROOF_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            // $file->move(public_path("uploads/proof"), $fileName);

            // Simpan booking ke database
            $booking = BookingSalon::create([
                'invoice' => "INV_TANGERINE_" . date("Ymdhis") . Auth::user()->id . "_" . strtoupper(Str::random(10)),
                'user_id' => Auth::user()->id,
                'schedule_id' => $schedule->id,
                'service_id' => $request->service_id,
                'booking_date' => $request->date,
                'customer_name' => $request->name,
                'phone_number' => $request->whatsapp,
                // 'payment_proof' => $fileName,
                'queue_number' => $queueNumber,
                'status' => 'pending'
            ]);

            $data = [
                "invoice" => $booking->invoice,
                "transaction_date" => $booking->created_at,
                "label" => Service::find($request->service_id)->name,
                "customer_name" => $request->name,
                "booking_date" => $request->date,
                "session" => $request->session,
                "queue_number" => $queueNumber,
                "total" => Service::find($request->service_id)->price,
                // "proof_of_payment" => $fileName
            ];

            Mail::to(Auth::user()->email)->queue(new SendInvoiceBookingSalon($data));
            Mail::to("website@tangerine.my.id")->queue(new SendInvoiceBookingSalon($data));

            return response()->json(['redirect_url' => route('services.salon')]);
        } catch (\Exception $e) {
            // Log::error('Error in storeBooking:', ['error' => $e->getMessage()]);
            // notificationFlash("error", $e->getMessage());
            return response()->json([
                'redirect_url' => route('services.salon'),
                // 'queue_number' => $booking->queue_number
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $transaction = BookingSalon::findOrFail($id);
            $transaction->update([
                "status" => $request->status // Sekarang bisa 'confirmed' atau 'cancelled'
            ]);

            $title = "Your transaction has been " . $request->status;

            $data = [
                "invoice" => $transaction->invoice,
                "transaction_date" => $transaction->created_at,
                "label" => Service::find(id: $transaction->service_id)->name,
                "customer_name" => $transaction->customer_name,
                "booking_date" => $transaction->booking_date,
                "session" => $transaction->schedule_service->session,
                "queue_number" => $transaction->queue_number,
                "total" => Service::find($transaction->service_id)->price,
                "proof_of_payment" => $transaction->payment_proof,
                "title" => $title,
            ];

            Mail::to($transaction->user->email)->queue(new SendReplyFromAdminBookingSalon($data, $title));
            DB::commit();

            notificationFlash("success", "Successfully updated transaction status.");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", $e->getMessage());
            return response()->json(["success" => false, "message" => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $transaction = BookingSalon::select(
            'bookings.customer_name',
            'services.name as service',
            'services.price',
            'bookings.booking_date',
            'schedule_services.session',
            'bookings.queue_number',
            'bookings.created_at',
            'bookings.payment_status'
        )
            ->join('services', 'bookings.service_id', '=', 'services.id')
            ->join('schedule_services', 'bookings.schedule_id', '=', 'schedule_services.id')
            ->where('bookings.id', $id)
            ->first();

        return response()->json([
            "html" => view("components.modal-detail-transaction", [
                "transaction" => $transaction,
            ])->render(),
        ]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $transaction = BookingSalon::findOrFail($id);
            $transaction->delete();

            DB::commit();
            notificationFlash("success", "Transaction successfully deleted");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            notificationFlash("error", "Failed to delete transaction: " . $e->getMessage());
            return response()->json(["success" => false]);
        }
    }

    public function upload_proof(Request $request)
    {
        $transaction = BookingSalon::findOrFail($request->transaction_id);
        if ($request->hasFile("proof_of_payment")) {
            $file = $request->file("proof_of_payment");
            $fileName = "PROOF_IMAGE_" . date("Ymdhis") . "_" . Str::random(10) . "." . $file->extension();
            $file->move(public_path("uploads/proofs"), $fileName);

            $transaction->update([
                "proof_of_payment" => $fileName,
                "payment_status" => "paid",
            ]);

            notificationFlash("success", "Successfully Upload Proof");
            return response()->json(["success" => true]);
        }

        notificationFlash("error", "No file uploaded");
        return response()->json(["success" => false]);
    }
}
