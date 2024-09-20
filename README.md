# Simple invoice

A simple invoice generator created for demonstating some of the skills I possess using Laravel 11, Vue 3, MySQL, PHP v.8.3

To run this project into your local environment:

> Make sure you have docker installed in your system.

-   Clone the repo

Run these commands from console/wsl:

```
./vendor/bin/sail up
./vendor/bin/sail npm install
./vendor/bin/sail composer install
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail npm run dev

```

> If everything went well without any error, you should be able to run the project at this point.

The default account creds with seeded data is :

```
test@example.com
password

```

Feel free to create your own account and play around!

If you want to avoid typing ./vendor/bin/sail, fin the .bashrc file from your root folder and add :

```
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

And at last, it's not a perfectly written project. As I have rushed it to showcase something on my portfolio. Will be deploying it live in the near future.
