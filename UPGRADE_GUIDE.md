# Upgrade guide

## From any version to 5.1.x
From version 5.1.0, PESEL rule additionally check if birthdate encoded in given number is correct.
From now on, PESEL number as "00000000000", "44444444444" will no longer pass validation.
If your system accept or store numbers like this, the update may cause the application to malfunction.

See [PESEL birthdate encoding method](https://pl.wikipedia.org/wiki/PESEL#Data_urodzenia) for more information.
