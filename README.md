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
Go to the ``src`` directory and run the following command in the terminal.
```bash
docker-compose -p web-docker-yii2 -f yii2.yml up -d
```
- ``localhost:8080`` Log in to the address with the information below.
```
Username: root
Password: root
```
- Create an empty database named ``portalium``.
- Open a terminal in the yii2-php container and load the database by following the commands:
- If you are using a Mac computer, you do not need to use the ``--noIndex`` parameter.
```
1. bash
2. cd portalium/
3. php init --noIndex
4. 0
5. yes
6. db
7. portalium
8. root
9. root
10. yes
```

## Login
You can access the storage module in your browser with the following information:
```
Username: admin
Password: 123456
http://portalium/storage/default/index
```
