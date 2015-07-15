#!/usr/bin/python

import os
import psycopg2
import random
execfile('my_creds.py')
img_array = ['.jpg','.jpeg','.png','.bmp','.gif']
audio_array = ['.mp4','.m4a']
est_paths=[]
try:
	conn = psycopg2.connect("dbname="+db+" user="+user+" password="+password) 
	cur = conn.cursor()
	cur.execute("UPDATE img_media SET d_id = 1;UPDATE audio_media SET d_id =1;UPDATE derives SET d_path = 1 WHERE d_id = 1;")
	conn.commit()
	conn.close()
except psycopg2.Error as e:
	print e