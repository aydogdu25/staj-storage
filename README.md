## Storage Module (Yii2 Framework)

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
Go to web-docker directory and run the following command in terminal.
```bash
docker-compose -p web-docker-yii2 -f yii2.yml up -d
```
- Open a terminal in the yii2-php container and install the database with the following command:
- If you are using a Mac computer, you do not need to use the ``--noIndex`` parameter.
```
php migration --noIndex
```
- You can access the Storage module by going to the following address in your browser:
```http 
http://portalium/storage/default/index
```
