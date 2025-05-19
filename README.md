## Storage Module (Yii2 Framework)

---
## Clone
```bash
git clone https://github.com/aydogdu25/staj-storage
```
## Configuration
Go to the etc\hosts directory for the virtual server and add the following record.
- Windows: ``C:\Windows\System32\drivers\etc\hosts``
- Linux/Mac: ``/etc/hosts``
```
127.0.0.1 portalium
```
## Run
```bash
docker-compose -p web-docker-yii2 -f yii2.yml up -d
```
- You can access the Storage module by going to the following address in your browser:
```http 
http://portalium/storage/default/index
```
