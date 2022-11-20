# Class GUID.php
## REQUIREMENTS
- PHP 8+

## STATIC FUNCTIONS

---
### GUID::generate()
Generate a new GUID  

@param {bool} $onlyCaseInsensitive - default `false` for accept lowercase letters  
@return {string} - the new guid
```php
echo new GUID(); // aff68246-a265-443a-8942-29727d5b6fbb
echo GUID::generate(); // dc33c32f-f1d4-493c-a5c2-121dbe5df063
```
---
### GUID::isValid()
Checks whether the GUID is valid  

@param {string} $guid the guid as string  
@param {bool} $onlyCaseInsensitive - default `false` for accept lowercase letters  
@return {bool}

```php
GUID::isValid("dc33c32f-f1d4-493c-a5c2-121dbe5df063"); // true
GUID::isValid("hello-world"); // false
```
---
### GUID::isEmpty()  
Checks whether the GUID is protected and contains only zeros  

@param {string} $guid the guid as string  
@return {bool}
```php
GUID::isEmpty("00000000-0000-0000-0000-000000000000"); // true
GUID::isEmpty(null); // false
GUID::isEmpty(""); // false
GUID::isEmpty("dc33c32f-f1d4-493c-a5c2-121dbe5df063"); // false
```
---