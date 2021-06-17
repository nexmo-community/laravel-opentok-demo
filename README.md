Getting Started with Vonage Video and Laravel Sample Repo
============================

This repo contains sample code that is used for the Vonage UNLOCKED "Getting
Started with Vonage Video and Laravel".

You can use this repository to reference code as you watch the video, or to
come back to later. If you are following along and get stuck, you can jump
between various parts by switching branches. Each branch will get you to the
starting point for each section.

## Getting Started

This repository is meant to be used as a reference item, but you could use
this is as a starting point for working. You will need to do the following:

1. Copy `.env.example` to `.env`
1. Edit the `DB_*` sections to match your DB criteria
1. Run `composer install` to install any needed dependencies
1. Run `php artisan migrate` to run any database migrations
1. Run `npm install` to install any JS dependencies
1. Run `npm run dev` to build any JS components

## Available Branches
- 01-setting-up-laravel
- 02-setting-up-laravel-breeze
- 03-setting-up-vonage
- 04-our-first-room
- 05-setting-up-the-client-side
- 06-letting-users-create-rooms
- 07-signalling-events