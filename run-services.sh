#!/bin/bash
# clean old env
docker stop sti_project
docker rm -f sti_project
# download image
docker run -ti -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018
#run web service
docker exec -u root sti_project service nginx start
#run php service
docker exec -u root sti_project service php5-fpm start