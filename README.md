# Start Guide

1) Clone this project

2) In project directory, run in terminal: 
   
   ```shell
   composer install
   ```
3. To create a Docker build, run in terminal:
   
   ```shell
   docker build -t api-server .
   ```

4. To create and run Docker container, run in terminal:
   
   ```shell
   docker run --name api-server-container --rm -p 8080:8080 api-server
   ```

5. To test API request, edit and use shell scripts from `api_test_curls` directory

6. To stop Docker container, press `Ctrl+C`


