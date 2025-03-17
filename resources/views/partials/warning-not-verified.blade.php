@if (verifiedUser())
    <div class="fixed z-10 bottom-0 right-0 lg:bottom-5 lg:right-5">
        <div class="flex items-center p-4 mb-4 w-[500px] text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Warning!</span> your account has not been verified, please check your
                email and verify it so you can still access all pages.
            </div>
        </div>
    </div>
@endif
