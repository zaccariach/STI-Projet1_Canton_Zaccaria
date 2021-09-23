#!/bin/bash

#run web service
docker exec -u root sti_project service nginx start

#run php service
docker exec -u root sti_project service php5-fpm start