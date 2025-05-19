<p>

<h1 align="center">Yii2 Site Management</h1>

This module allows you to create a new user and enables an existing user to log in.
- Login and signup.
- Getting currently logged in identity.
- Active-passive user control
- E-mail verification
- Resending the verification email
- E-mail confirmation settings

## Requirements

-PHP 7.4 or higher

## Installation
```
composer require portalium/yii2-site "*"
```

or for the dev-master

```
composer require portalium/yii2-site "*"
```

Or, you may add

```
"portalium/yii2-site": "*"
```

to the require section of your `composer.json` file and execute `composer update`.




## General usage

#### Login
The login method checks whether the mail control settings are enabled after verifying the user information.

### E-mail verification
The actionVerifyEmail method is a function that performs the email verification process for the user and does so using a token.

### Resend Verification Email
This method provides users with a way to resend verification emails when needed.

### Email Confirmation settings
It inserts a setting named 'Email Confirmation' into a database table associated with the 'site' module. This setting is displayed in the user interface using a radio button. The 'Email Confirmation' option can be set as 'Active' or 'Passive', and based on this selection. <br/>

### Code Contributors

This project exists thanks to all the people who contribute.



## Package development

Once you have created your package, you can create the components, controllers, models, database migrations, and views within the package.

Here are some links with more information about components, controllers, models, database migrations, and views:

- [Creating a component](https://www.yiiframework.com/doc/guide/2.0/en/concept-components)
- [Creating a controller](https://www.yiiframework.com/doc/guide/2.0/en/structure-controllers)
- [Creating a model](https://www.yiiframework.com/doc/guide/2.0/en/structure-models)
- [Creating a database migration](https://www.yiiframework.com/doc/guide/2.0/en/db-migrations)
- [Creating a view](https://www.yiiframework.com/doc/guide/2.0/en/structure-views)

## License
The Portalium  is free software. It is released under the terms of the BSD License.
Please see [`LICENSE`](./LICENSE.md) for more information.

Maintained by [Portalium Software](https://www.yiiframework.com/).

## Follow updates
[![Linkedin](https://img.shields.io/badge/linkedin-join-1DA1F2?style=flat&logo=linkedin)](https://www.linkedin.com/company/diginova-informatics/)