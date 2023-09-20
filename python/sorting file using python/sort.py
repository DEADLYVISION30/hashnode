import os
import shutil
for item in os.listdir():
    ex=item.split('.')
    src=os.getcwd()+'/'+item
    if(len(ex)>1 and item!="sort.py"):
        dst=os.getcwd()+'/'+ex[-1]+'/'
        if os.path.exists(dst):
            shutil.move(src,dst)
        else:
            os.mkdir(dst)
            shutil.move(src,dst)