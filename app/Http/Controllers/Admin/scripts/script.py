import os, sys
import csv, glob
from ctypes.util import find_library
print(find_library("gs")) #will display libgs.so.9 if installed; will print None if not
import camelot
fileName = sys.argv[1]
password = sys.argv[2]
path = "E:\\sync\\college\\S.P.I.T\\sem-6\\MiniProject\\fintracker\\public\\assets\\uploads\\account_statements\\{}".format(fileName)

tables = camelot.read_pdf(path ,pages='all', password=password)

# Exporting the converted csv files
tables.export('./assets/output/{}.csv'.format(fileName), f='csv')

Dir = r"./assets/output"
Avg_Dir = r"./assets/output/merged"

csv_file_list = glob.glob(os.path.join(Dir, '*.csv')) # returns the file list
# print (csv_file_list)

# Merging the files
with open(os.path.join(Avg_Dir, '{}-merged.csv'.format(fileName)), 'w', newline='') as f:
    wf = csv.writer(f, lineterminator='\n')
    flag = True
    for files in csv_file_list:
        with open(files, 'r') as r:
            # next(r)       # SKIP HEADERS
            rr = csv.reader(r)
            for row in rr:
                if row[0] != '':
                    if flag:
                        if row[0] == 'Date':
                            for i in range(len(row)):
                                if row[i] == 'Particulars':
                                    row[i] = 'Description'
                            wf.writerow(row)
                            flag = False
                    else:
                        if row[0] != 'Date' and 'a' not in row[0]:
                            print(row)
                            wf.writerow(row)

# Deleting the csv files after merging
for filePath in csv_file_list:
    try:
        os.remove(filePath)
    except OSError:
        print(f"Error while deleting file : {filePath}")
