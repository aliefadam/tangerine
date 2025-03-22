<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\BeauticianController;
use App\Http\Controllers\BookingSalonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberPlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentTransactionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckSessionUser;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth", AdminMiddleware::class, CheckSessionUser::class])->group(function () {
    Route::prefix("admin")->group(function () {
        Route::get("/", function () {
            return to_route("admin.dashboard");
        });
        Route::get("/dashboard", [BackendController::class, "dashboard"])->name("admin.dashboard");

        Route::prefix("member")->group(function () {
            Route::get("/", [MemberController::class, "index"])->name("admin.member.index");
            Route::get("/{id}", [MemberController::class, "show"])->name("admin.member.show");
        });

        Route::prefix("member-plan")->group(function () {
            Route::get("/{id}", [MemberPlanController::class, "show"])->name("admin.member-plan.show");
        });

        Route::prefix("trainer")->group(function () {
            Route::get("/", [TrainerController::class, "index"])->name("admin.trainer.index");
            Route::get("/create", [TrainerController::class, "create"])->name("admin.trainer.create");
            Route::post("/store", [TrainerController::class, "store"])->name("admin.trainer.store");
            Route::get("/edit/{id}", [TrainerController::class, "edit"])->name("admin.trainer.edit");
            Route::put("/update/{id}", [TrainerController::class, "update"])->name("admin.trainer.update");
            Route::delete("/destroy/{id}", [TrainerController::class, "destroy"])->name("admin.trainer.destroy");
        });

        Route::prefix("course")->group(function () {
            Route::get("/", [CourseController::class, "index"])->name("admin.course.index");
            Route::get("/create", [CourseController::class, "create"])->name("admin.course.create");
            Route::post("/store", [CourseController::class, "store"])->name("admin.course.store");
            Route::get("/edit/{id}", [CourseController::class, "edit"])->name("admin.course.edit");
            Route::put("/update/{id}", [CourseController::class, "update"])->name("admin.course.update");
            Route::delete("/destroy/{id}", [CourseController::class, "destroy"])->name("admin.course.destroy");
        });

        Route::prefix("course-detail")->group(function () {
            Route::get("/", [CourseDetailController::class, "index"])->name("admin.course-detail.index");
            Route::get("/create", [CourseDetailController::class, "create"])->name("admin.course-detail.create");
            Route::post("/store", [CourseDetailController::class, "store"])->name("admin.course-detail.store");
            Route::get("/edit/{id}", [CourseDetailController::class, "edit"])->name("admin.course-detail.edit");
            Route::put("/update/{id}", [CourseDetailController::class, "update"])->name("admin.course-detail.update");
            Route::delete("/destroy/{id}", [CourseDetailController::class, "destroy"])->name("admin.course-detail.destroy");
        });

        Route::prefix("room")->group(function () {
            Route::get("/", [RoomController::class, "index"])->name("admin.room.index");
            Route::get("/create", [RoomController::class, "create"])->name("admin.room.create");
            Route::post("/store", [RoomController::class, "store"])->name("admin.room.store");
            Route::get("/edit/{id}", [RoomController::class, "edit"])->name("admin.room.edit");
            Route::put("/update/{id}", [RoomController::class, "update"])->name("admin.room.update");
            Route::delete("/destroy/{id}", [RoomController::class, "destroy"])->name("admin.room.destroy");
        });

        Route::prefix("schedule")->group(function () {
            Route::get("/", [ScheduleController::class, "index"])->name("admin.schedule.index");
            Route::get("/create", [ScheduleController::class, "create"])->name("admin.schedule.create");
            Route::post("/store", [ScheduleController::class, "store"])->name("admin.schedule.store");
            Route::get("/{date}/show", [ScheduleController::class, "show"])->name("admin.schedule.show");
            Route::get("/edit/{id}", [ScheduleController::class, "edit"])->name("admin.schedule.edit");
            Route::put("/update/{id}", [ScheduleController::class, "update"])->name("admin.schedule.update");
            Route::delete("/destroy/{id}", [ScheduleController::class, "destroy"])->name("admin.schedule.destroy");
        });

        Route::prefix("time-table")->group(function () {
            Route::get("/", [TimeTableController::class, "index"])->name("admin.time-table.index");
            Route::get("/create", [TimeTableController::class, "create"])->name("admin.time-table.create");
            Route::post("/store", [TimeTableController::class, "store"])->name("admin.time-table.store");
            Route::get("/edit/{id}", [TimeTableController::class, "edit"])->name("admin.time-table.edit");
            Route::put("/update/{id}", [TimeTableController::class, "update"])->name("admin.time-table.update");
            Route::delete("/destroy/{id}", [TimeTableController::class, "destroy"])->name("admin.time-table.destroy");
        });

        Route::prefix("member-plan")->group(function () {
            Route::get("/", [MemberPlanController::class, "index"])->name("admin.member-plan.index");
            Route::get("/create", [MemberPlanController::class, "create"])->name("admin.member-plan.create");
            Route::post("/store", [MemberPlanController::class, "store"])->name("admin.member-plan.store");
            Route::get("/edit/{id}", [MemberPlanController::class, "edit"])->name("admin.member-plan.edit");
            Route::put("/update/{id}", [MemberPlanController::class, "update"])->name("admin.member-plan.update");
            Route::delete("/destroy/{id}", [MemberPlanController::class, "destroy"])->name("admin.member-plan.destroy");
        });

        Route::prefix("beautician")->group(function () {
            Route::get("/", [BeauticianController::class, "index"])->name("admin.beautician.index");
            Route::get("/create", [BeauticianController::class, "create"])->name("admin.beautician.create");
            Route::post("/store", [BeauticianController::class, "store"])->name("admin.beautician.store");
            Route::get("/edit/{id}", [BeauticianController::class, "edit"])->name("admin.beautician.edit");
            Route::put("/update/{id}", [BeauticianController::class, "update"])->name("admin.beautician.update");
            Route::delete("/destroy/{id}", [BeauticianController::class, "destroy"])->name("admin.beautician.destroy");
        });

        Route::prefix("service")->group(function () {
            Route::get("/", [ServiceController::class, "index"])->name("admin.service.index");
            Route::get("/create", [ServiceController::class, "create"])->name("admin.service.create");
            Route::post("/store", [ServiceController::class, "store"])->name("admin.service.store");
            Route::get("/edit/{id}", [ServiceController::class, "edit"])->name("admin.service.edit");
            Route::put("/update/{id}", [ServiceController::class, "update"])->name("admin.service.update");
            Route::delete("/destroy/{id}", [ServiceController::class, "destroy"])->name("admin.service.destroy");
        });

        Route::prefix("product")->group(function () {
            Route::get("/", [ProductController::class, "index"])->name("admin.product.index");
            Route::get("/create", [ProductController::class, "create"])->name("admin.product.create");
            Route::post("/store", [ProductController::class, "store"])->name("admin.product.store");
            Route::get("/{date}/show", [ProductController::class, "show"])->name("admin.product.show");
            Route::get("/edit/{id}", [ProductController::class, "edit"])->name("admin.product.edit");
            Route::put("/update/{id}", [ProductController::class, "update"])->name("admin.product.update");
            Route::delete("/destroy/{id}", [ProductController::class, "destroy"])->name("admin.product.destroy");
        });

        Route::prefix("booking-salon")->group(function () {
            Route::get("/", [BookingSalonController::class, "index"])->name("admin.booking-salon.index");
            Route::get("/show/{id}/detail", [BookingSalonController::class, "show"])->name("admin.booking-salon.show");
            Route::get("/create", [BookingSalonController::class, "create"])->name("admin.booking-salon.create");
            Route::post("/store", [BookingSalonController::class, "store"])->name("admin.booking-salon.store");
            Route::get("/edit/{id}", [BookingSalonController::class, "edit"])->name("admin.booking-salon.edit");
            Route::put("/update/{id}", [BookingSalonController::class, "update"])->name("admin.booking-salon.update");
            Route::delete("/destroy/{id}", [BookingSalonController::class, "destroy"])->name("admin.booking-salon.destroy");
        });

        Route::prefix("transaction")->group(function () {
            Route::get("/", [TransactionController::class, "index"])->name("admin.transaction.index");
            Route::get("/show/{id}/detail", [TransactionController::class, "show"])->name("admin.transaction.show");
            Route::get("/create", [TransactionController::class, "create"])->name("admin.transaction.create");
            Route::post("/store", [TransactionController::class, "store"])->name("admin.transaction.store");
            Route::get("/edit/{id}", [TransactionController::class, "edit"])->name("admin.transaction.edit");
            Route::put("/update/{id}", [TransactionController::class, "update"])->name("admin.transaction.update");
            Route::delete("/destroy/{id}", [TransactionController::class, "destroy"])->name("admin.transaction.destroy");
        });

        Route::prefix("rent-transaction")->group(function () {
            Route::get("/", [RentTransactionController::class, "index"])->name("admin.rent-transaction.index");
            Route::get("/show/{id}/detail", [RentTransactionController::class, "show"])->name("admin.rent-transaction.show");
            Route::get("/create", [RentTransactionController::class, "create"])->name("admin.rent-transaction.create");
            Route::post("/store", [RentTransactionController::class, "store"])->name("admin.rent-transaction.store");
            Route::get("/edit/{id}", [RentTransactionController::class, "edit"])->name("admin.rent-transaction.edit");
            Route::put("/update/{id}", [RentTransactionController::class, "update"])->name("admin.rent-transaction.update");
            Route::delete("/destroy/{id}", [RentTransactionController::class, "destroy"])->name("admin.rent-transaction.destroy");
        });

        Route::get("/change-password", [BackendController::class, "change_password"])->name("admin.change-password");
        Route::put("/change-password", [BackendController::class, "change_password_post"])->name("admin.change-password-post");
    });
});
