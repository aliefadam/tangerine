<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberPlanController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::prefix("admin")->group(function () {
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

        Route::prefix("transaction")->group(function () {
            Route::get("/", [TransactionController::class, "index"])->name("admin.transaction.index");
            Route::get("/show/{id}/detail", [TransactionController::class, "show"])->name("admin.transaction.show");
            Route::get("/create", [TransactionController::class, "create"])->name("admin.transaction.create");
            Route::post("/store", [TransactionController::class, "store"])->name("admin.transaction.store");
            Route::get("/edit/{id}", [TransactionController::class, "edit"])->name("admin.transaction.edit");
            Route::put("/update/{id}", [TransactionController::class, "update"])->name("admin.transaction.update");
            Route::delete("/destroy/{id}", [TransactionController::class, "destroy"])->name("admin.transaction.destroy");
        });

        Route::get("/change-password", [BackendController::class, "change_password"])->name("admin.change-password");
        Route::put("/change-password", [BackendController::class, "change_password_post"])->name("admin.change-password-post");
    });
});
