# Smartphone Localization with Android, PHP, and MySQL

## Overview

This project consists of an Android application that retrieves the geographic location of a smartphone and sends it to a remote PHP server. The server processes the request and stores the data in a MySQL database.

The system follows this flow:

Android → HTTP POST (Volley) → PHP → MySQL

---

## Project Architecture

### Server Side

* MySQL database
* PHP backend
* DAO structure (Position, Service, Connection)

### Mobile Side

* Android application (Java)
* GPS location retrieval
* HTTP communication using Volley

---

## Database Setup

```sql
CREATE DATABASE IF NOT EXISTS localisation
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE localisation;

CREATE TABLE position (
    id INT AUTO_INCREMENT PRIMARY KEY,
    latitude DOUBLE NOT NULL,
    longitude DOUBLE NOT NULL,
    date_position DATETIME NOT NULL,
    imei VARCHAR(50) NOT NULL
);
```

---

## PHP Project Structure

```text
localisation/
├── classe/
│   └── Position.php
├── connexion/
│   └── Connexion.php
├── dao/
│   └── IDao.php
├── service/
│   └── PositionService.php
└── createPosition.php
```

---

## Main PHP Endpoint

`createPosition.php` receives POST data and inserts it into the database.

Expected POST parameters:

* latitude
* longitude
* date_position
* imei

---

## Postman Test (IMPORTANT)

### Request

* Method: POST
* URL:

```text
http://localhost/localisation/createPosition.php
```

### Body → x-www-form-urlencoded

```text
latitude=33.5
longitude=-7.6
date_position=2026-04-27 18:00:00
imei=123456
```
<img width="954" height="1030" alt="Screenshot 2026-04-27 202108" src="https://github.com/user-attachments/assets/4ef65073-b84a-4b1f-9fd6-d1683ce2943d" />

### Expected Response

```text
Position enregistrée avec succès
```

### Common Errors

* "Paramètres manquants" → wrong keys (example: latitude_ instead of latitude)
* 404 → wrong URL or file location
* Empty POST → wrong Body format

---

## Android Configuration

### Permissions (AndroidManifest.xml)

```xml
<uses-permission android:name="android.permission.ACCESS_FINE_LOCATION"/>
<uses-permission android:name="android.permission.ACCESS_COARSE_LOCATION"/>
<uses-permission android:name="android.permission.INTERNET"/>
<uses-permission android:name="android.permission.READ_PHONE_STATE"/>
```

Inside `<application>`:

```xml
android:usesCleartextTraffic="true"
```

---

## Dependencies

```gradle
implementation("com.android.volley:volley:1.2.1")
```

---

## Server URL Configuration

### Emulator

```java
http://10.0.2.2/localisation/createPosition.php
```

### Real Device

```java
http://YOUR_PC_IP/localisation/createPosition.php
```

---

## Android Features

* Retrieves GPS location using LocationManager
* Displays latitude and longitude
* Sends data using HTTP POST (Volley)
* Includes:

  * latitude
  * longitude
  * date
  * imei

---

## Testing on Emulator

1. Run the application
2. Accept permissions
3. Open emulator controls:

```text
Three dots (...) → Location
```
<img width="515" height="860" alt="Screenshot 2026-04-27 205827" src="https://github.com/user-attachments/assets/21304445-a9a2-4bcc-9989-00b46fd169b6" />

4. Enter coordinates:

```text
Latitude: 33.5731
Longitude: -7.5898
```

5. Click Send

---

## Verification

Open phpMyAdmin:

```text
Database: localisation
Table: position
```

You should see inserted rows containing:

* latitude
* longitude
* date_position
* imei

---

## Final Result

The application successfully:

* detects smartphone location
* displays it on screen
* sends data to PHP server
* stores it in MySQL database
