 
```markdown
# CMD Quick Commands

### **Create**
```cmd
mkdir "folder"            # Create folder
type nul > "file.txt"     # Create empty file
echo content > "file"     # Create file with text
```

### **Delete**
```cmd
del "file.txt"            # Delete file
rd /s /q "folder"         # Delete folder (force)
```

### **Copy**
```cmd
xcopy "source\*" "dest\" /E /H /I /Y  # Copy folder (with subfolders/hidden files)
robocopy "source" "dest" /E /ZB       # Alternative (robust)
```

### **Rename/Move**
```cmd
ren "old.txt" "new.txt"   # Rename file/folder
move "file" "dest\"       # Move file/folder
```

### **Search**
```cmd
dir /s *name*             # Find file/folder
findstr "text" "file"     # Search text in file
```

### **File/Folder Info**
```cmd
dir "file"                # Show details
dir /a                   # Show hidden files
```

### **Troubleshooting**
```cmd
git config --system core.longpaths true  # Fix long path errors
```

### **Notes**
- Use quotes (`" "`) for paths with spaces.
- Replace `source`/`dest` with actual paths.
- Run CMD as **Admin** for permission issues.
```

---

**Example Workflow**:  
```cmd
xcopy "C:\source\vendor\*" "C:\dest\vendor\" /E /H /I /Y
```
 