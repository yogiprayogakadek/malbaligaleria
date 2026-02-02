import os
import string

# Target directory relative to the script location (project root)
target_dir = r"public/assets/images/tenant_logo"
base_path = os.getcwd()
full_path = os.path.join(base_path, target_dir)

if not os.path.exists(full_path):
    print(f"Error: Directory not found at {full_path}")
    exit(1)

print(f"Scanning directory: {full_path}")

renamed_count = 0
errors = []

for filename in os.listdir(full_path):
    file_path = os.path.join(full_path, filename)
    
    # Process only files
    if os.path.isfile(file_path):
        # Split name and extension
        name, ext = os.path.splitext(filename)
        
        # Convert to Title Case (Start Every Word With Capital)
        # string.capwords handles "bath & body works" -> "Bath & Body Works" correctly
        new_name = string.capwords(name.replace("-", " ").replace("_", " ")) 
        # Optional: Restore dashes if they were separators? 
        # Usually filenames match tenant names which might have spaces.
        # Let's just assume Title Case on valid separator words.
        
        new_filename = new_name + ext
        
        # Check if renaming is needed
        if new_filename != filename:
            new_file_path = os.path.join(full_path, new_filename)
            
            try:
                # Rename the file
                os.rename(file_path, new_file_path)
                print(f"Renamed: {filename} -> {new_filename}")
                renamed_count += 1
            except Exception as e:
                error_msg = f"Failed to rename {filename}: {str(e)}"
                print(error_msg)
                errors.append(error_msg)

print("-" * 30)
print(f"Process Complete.")
print(f"Total files renamed: {renamed_count}")
if errors:
    print(f"Errors encountered: {len(errors)}")
