#!/usr/bin/python

import os
import psycopg2
import random
execfile('my_creds.py')
img_array = ['.jpg','.jpeg','.png','.bmp','.gif']
est_paths=[]
try:
	conn = psycopg2.connect("dbname="+db+" user="+user+" password="+password) 
	cur = conn.cursor()
	cur.execute("SELECT i_path FROM img_media;")
	t_est_paths = cur.fetchall()
	conn.close()
except psycopg2.Error as e:
	print e
for i in t_est_paths:
	 est_paths.append(i[0])#list of current paths in there.

def toInsert(est_paths,file_path):
	if file_path in est_paths:
		print "this shit exists " + file_path
		pass
	else:
		x = file_path.split("/")
		i=0
		while i < len(x):#find authors name
			if x[i]=="authors":
				author = x[i+1]
				file_path = '/'.join(x[i:len(x)])
				print file_path
				break
			i+=1
		try:
			conn = psycopg2.connect("dbname="+db+" user="+user+" password="+password) 
			cur = conn.cursor()
			cur.execute("SELECT MAX(d_id) from derives;")#get d_id
			max_d_id=cur.fetchone()[0]
			d_id = random.randrange(0,max_d_id+1)#randomize derive_id
			cur.execute("INSERT INTO img_media(d_id,i_path,author) VALUES(%s,%s,%s);", (d_id,file_path, author))
			conn.commit()
			conn.close()
			print "i insert"
		except psycopg2.DatabaseError, e:
			print e

def traverse(path):
	try: 
		os.listdir(path)
		f = os.listdir(path)
		for i in f:#traverse listed files in dir
			for img_type in img_array:#check against file type
				if img_type in i:
					print path+"/"+i
					toInsert(est_paths,path+"/"+i)
			traverse(path+"/"+i)
	except OSError, msg:
		pass

# for author in os.listdir(authors_path):
# 	for proj in os.listdir(authors_path+"/"+author):
# 		proj_path = authors_path+"/"+author+"/"+proj
# 		for the_file in os.listdir(proj_path):
# 			print proj + " by " + author + " : " + the_file
# 			for img_type in img_array:#iterate through image array

# 				if img_type in the_file:#check if it's an image and add it to the db.
# 					file_path = proj_path+"/"+the_file
# 					try:
# 						conn = psycopg2.connect("dbname="+db+" user="+user+" password="+password) 
# 						cur = conn.cursor()
# 						cur.execute("INSERT INTO img_media(i_path,author) VALUES(%s,%s);", (file_path, author))
# 						conn.commit()
# 						conn.close()
# 					except psycopg2.DatabaseError, e:
# 						print e
traverse(authors_path)