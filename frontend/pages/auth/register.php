<?php

if (session()->auth())
    response()->redirect(site_url(session()->auth()->getRole()->redirectPage()));

?>
<main class="bg-gray-100 min-h-screen">
    <div class="container mx-auto h-screen flex items-center justify-center">
        <div class="card w-96 bg-white border-2 mx-auto">
            <div class="card-body mt-18">
                <h2 class="card-title">Log in to your account !</h2>
                <div class="cart-body">
                    <div>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">email or username</span>
                            </div>
                            <input type="text" class="input input-sm input-bordered w-full max-w-xs" />
                        </label>
                    </div>
                    <div>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">password</span>
                            </div>
                            <input type="password" class="input input-sm input-bordered w-full max-w-xs" />
                        </label>
                    </div>
                    <div>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">re-type password</span>
                            </div>
                            <input type="password" class="input input-sm input-bordered w-full max-w-xs" />
                        </label>
                    </div>
                </div>
                <div class="card-actions justify-between items-center mt-2">
                    <a class="link link-error text-sm">registered?</a>
                    <button class="btn btn-sm btn-neutral">Log in</button>
                </div>
            </div>
        </div>
    </div>
</main>