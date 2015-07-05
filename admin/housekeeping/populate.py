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
	cur.execute("DELETE FROM img_media;")
	conn.commit()
	conn.close()
except psycopg2.Error as e:
	print e
try:
	conn = psycopg2.connect("dbname="+db+" user="+user+" password="+password) 
	cur = conn.cursor()
	cur.execute("DELETE FROM audio;")
	conn.commit()
	conn.close()
except psycopg2.Error as e:
	print e
try:
	conn = psycopg2.connect("dbname="+db+" user="+user+" password="+password) 
	cur = conn.cursor()
	cur.execute("SELECT content FROM img_media UNION ALL SELECT content FROM audio_media;")
	t_est_paths = cur.fetchall()#temporarily established paths.
	conn.close()
except psycopg2.Error as e:
	print e
for i in t_est_paths:
	 est_paths.append(i[0])#list of current paths in there.

def theInsert(est_paths,content,table):
	x = content.split("/")
	i=0
	while i < len(x):#find authors name
		if x[i]=="authors":
			author = x[i+1]
			content = '/'.join(x[i:len(x)])
			print content
			break
		i+=1
	if content in est_paths:
		print "this shit exists " + content
		pass
	else:
		print "down the hatch"
		try:
			conn = psycopg2.connect("dbname="+db+" user="+user+" password="+password) 
			cur = conn.cursor()
			cur.execute("SELECT count(d_id) from derives;")#get d_id
			max_d_id=cur.fetchone()[0]
			d_id = random.randrange(1,max_d_id+1)#randomize derive_id
			cur.execute("INSERT INTO "+table+"(d_id,content,author) VALUES(%s,%s,%s);", (d_id,content, author))
			conn.commit()
			conn.close()
			print "i insert"
		except psycopg2.DatabaseError, e:
			print e

def traverse(path):#for going through and finding each file @ dir. tries to insert on each file.
	try: 
		os.listdir(path)
		f = os.listdir(path)
		for i in f:#traverse listed files in dir
			print i
			for img_type in img_array:#check against file type
				if img_type in i:
					print "img found"
					theInsert(est_paths,path+"/"+i,"img_media")
			for a_type in audio_array:
				if a_type in i:
					print "audio found"
					theInsert(est_paths,path+"/"+i,"audio_media")
			traverse(path+"/"+i)
	except OSError, msg:
		pass


traverse(authors_path)