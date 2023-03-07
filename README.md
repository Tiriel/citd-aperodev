# Code in the Dark x SensioLabs
## Installation
For easier development process, the use of tne Symfony CLI is recommended and all commands are presented as such.
Remove `symfony` for composer commands, and replace `symfony console` by `php bin/console` for console commands.
* `git clone` this repository
* `cd citd-aperodev`
* `symfony composer install`
* `yarn install`
* `yarn encore dev`

This application is made to work with SQLite. Please change the `DATABASE_URL` value in `.env` file to match yours.
* `symfony console doctrine:database:create`

If you are not using SQLITE, please remove all files in `./migrations`.
Then, `symfony console doctrine:migrations:diff` before running the rest of the commands.
* `symfony console doctrine:migrations:migrate`
* `symfony console doctrine:fixtures:load`

If using the Symfony CLI, you can start the dev server with `symfony serve -d`.
Otherwise, you can start PHP dev server with `php -S 127.0.0.1:8000 -t public/`

You can visualize the full result of the exercise immediately.
To give a go at the challenge yourself, `git checkout 5c842f641f6169e38e50b21d74222e3102046d0d`
