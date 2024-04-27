<?php

if (session()->auth())
    response()->redirect(site_url(session()->auth()->getRole()->redirectPage()));

?>
<main class="bg-gray-100 min-h-screen">
    <div class="container mx-auto h-screen flex items-center justify-center">
        <form action="<?= site_url('auth/check') ?>" method="post">
            <div class="card w-96 bg-white border-2 mx-auto">
                <div class="card-body mt-18">
                    <h2 class="card-title">Masuk ke akun kamu !</h2>
                    <div class="cart-body">
                        <div>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">email atau nama pengguna</span>
                                </div>
                                <input name="username" type="text"
                                    class="input input-sm input-bordered w-full max-w-xs" />
                            </label>
                        </div>
                        <div>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">kata sandi</span>
                                </div>
                                <input name="password" type="password"
                                    class="input input-sm input-bordered w-full max-w-xs" />
                            </label>
                        </div>
                    </div>
                    <div class="card-actions justify-between items-center mt-2">
                        <a class="link link-error text-sm">lupa kata sandi?</a>
                        <button class="btn btn-sm btn-neutral">Masuk</button>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-sm text-center">
                <a href="register" class="link link-hover italic">daftar</a>
            </div>
        </form>
    </div>
</main>