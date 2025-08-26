# Google Drive API Beállítás

Ez a dokumentáció bemutatja, hogyan kell beállítani a Google Drive API-t a projekt teljesítési igazolások automatikus Google Docs dokumentum létrehozásához.

## 1. Google Cloud Console Beállítás

### 1.1 Projekt létrehozása
1. Menj a [Google Cloud Console](https://console.cloud.google.com/)-ra
2. Hozz létre egy új projektet vagy válassz ki egy meglévőt
3. Jegyezd fel a projekt ID-t

### 1.2 API-k engedélyezése
A következő API-kat kell engedélyezni:
- Google Drive API
- Google Docs API

```bash
# CLI-vel is engedélyezheted:
gcloud services enable drive.googleapis.com
gcloud services enable docs.googleapis.com
```

### 1.3 Service Account létrehozása
1. Navigálj az "IAM & Admin" > "Service Accounts" menüpontra
2. Kattints a "Create Service Account" gombra
3. Add meg a service account nevét és leírását
4. A szerepkör (Role) mezőben adj hozzá:
   - "Editor" vagy "Owner" szerepkört (vagy specifikusabb Drive/Docs jogokat)

### 1.4 Credentials letöltése
1. Kattints a létrehozott service account-ra
2. Menj a "Keys" tabra
3. Kattints "Add Key" > "Create New Key"
4. Válaszd a JSON formátumot
5. Töltsd le a JSON fájlt

## 2. Laravel Alkalmazás Konfiguráció

### 2.1 Credentials fájl elhelyezése
A letöltött JSON fájlt másold a következő helyre:
```
storage/app/google-credentials.json
```

### 2.2 Környezeti változók (.env)
```env
# Google Drive API
GOOGLE_DRIVE_ENABLED=true
GOOGLE_APPLICATION_CREDENTIALS=storage/app/google-credentials.json
```

## 3. Biztonsági Megjegyzések

### 3.1 Credentials védelem
- **SOHA** ne commitold a `google-credentials.json` fájlt a git repository-ba
- A fájl már fel van véve a `.gitignore`-ba
- Production környezetben használj environment változókat vagy titkosított tárolást

### 3.2 Jogosultságok
- A service account csak a szükséges minimum jogokkal rendelkezzen
- Rendszeresen ellenőrizd és frissítsd a jogosultságokat
- Használj specifikus Drive/Docs jogokat a helyett, hogy "Editor" vagy "Owner" jogot adsz

## 4. Tesztelés

### 4.1 Service működésének ellenőrzése
```php
// Tinker-ben tesztelheted:
$project = App\Models\Project::first();
$service = new App\Services\ProjectCompletionDocumentService($project);
$url = $service->createGoogleDoc();
echo $url;
```

### 4.2 Hibaelhárítás
- Ellenőrizd, hogy a credentials fájl létezik és olvasható
- Győződj meg róla, hogy az API-k engedélyezve vannak
- Nézd meg a Laravel log fájlokat hiba esetén

## 5. Használat

A Google Drive integráció a következőképpen működik:

1. A felhasználó a Filament admin felületen a projekt szerkesztési oldalán 
2. Rákattint a "Google Docs Export" gombra
3. A rendszer automatikusan létrehoz egy új Google Docs dokumentumot
4. A dokumentum feltöltésre kerül a service account Google Drive-jára
5. A felhasználó átirányításra kerül az új dokumentumra

## 6. Fallback Megoldás

Ha a Google Drive API nem elérhető vagy hibát dob, a rendszer automatikusan visszaáll a JSON export letöltésre, így a felhasználó mindig kap valamilyen kimenetet.