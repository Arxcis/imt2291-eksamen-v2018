# Eksamen i IMT2291, våren 2018 ved NTNU Gjøvik

### Info

* Studentnr: 473193
* Navn: Jonas Johan Solsvik
* Starttid: 13:34, 29.05.2018 (4.5 timer forsinket pga. eksamen i Ooprog)
* Sluttid:  14:57

### How to run oppgavene

#### Oppgave 1, 2, 3, 4 og 9

**1. Run a web server in the ./rc directory**
```
cd <projectroot>/rc
php -S localhost:4000
```

**2. Go to browser with following URLS**
```
http://localhost:4000/oppgave1.php
http://localhost:4000/oppgave2.php
http://localhost:4000/oppgave3.php
http://localhost:4000/oppgave4.php
http://localhost:4000/oppgave9.php
```

#### Oppgave 5

**1. Run a web server in ./twoFactorAuthentication**
```
cd ./twoFactorAuthentication
php -S localhost:4000
```

**2. Go to browser**
```
http://localhost:4000/oppgave5-loginuser.php
```


#### Oppgave 6 - unitest

```
$ ./vendor/bin/phpunit oppgave6-unittest.php 
PHPUnit 7.1.5 by Sebastian Bergmann and contributors.

...                                                                 3 / 3 (100%)

Time: 54 ms, Memory: 4.00MB

OK (3 tests, 5 assertions)
```

#### Oppgave 7 - functionaltest

**1. Start webserver in ./twoFactorAuthentication**
```
$ php -S localhost:4000
^[[3~PHP 7.1.14 Development Server started at Wed May 30 14:49:18 2018
Listening on http://localhost:4000
Document root is /Users/jsolsvik/git/arxcis/exam-wwwtek/twoFactorAuthentication
Press Ctrl-C to quit.
````

**2. While server is running run functionaltest**
```
$ ./vendor/bin/phpunit oppgave7-functionaltest.php 
PHPUnit 7.1.5 by Sebastian Bergmann and contributors.

....                                                                4 / 4 (100%)

Time: 80 ms, Memory: 6.00MB

OK (4 tests, 10 assertions)
```


#### Oppgave 8 - videoviewer

**1. Run a web server in ./YouTubeSearch**
```
cd ./twoFactorAuthentication
php -S localhost:4000
```

**2. Take browser to**
```
http://localhost:4000/oppgave8-viewsearch.php
```


#### Oppgave 10 og 11

**1. Run a api server in ./rc**
```
cd ./rc
php -S localhost:4000
```

**2. Run polymer server in** 
```
cd ./oppgave10-polymer
polymer serve


cd ./oppgave11-polymer
polymer serve
```

**3. Go to browser and enjoy**
```
http://localhost:8081/
```

