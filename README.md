# Start Guide

1) Clone this project

2) In project directory, run in terminal: 
   
   ```shell
   composer install
   ```
3. To change mod permissions for file **"emails.txt"**, run in terminal:
   
   ```shell
   chmod 777 emails.txt
   ```

4. To create a Docker build, run in terminal:

```shell
docker build -t api-server .
```

5. To create and run Docker container, run in terminal:

```shell
docker run --name api-server-container --rm -p 8080:8080 api-server
```

6. To check that server is working, go to this address in browser:

```url
http://localhost:8080/index.php
```

The line **"Server started"** should appear

7. To test API request, edit and use shell scripts from `api_test_curls` directory

8. To stop Docker container, press `Ctrl+C`
