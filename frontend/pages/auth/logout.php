-- Active: 1714104364314@@127.0.0.1@3306@netmon
<?php

session()->logout();
response()->redirectTo(site_url('auth/login'));