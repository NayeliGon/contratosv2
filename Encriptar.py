import bcrypt

# Generar un salt aleatorio
salt = bcrypt.gensalt()

# Contraseña original
contrasena_original = "admin"

# Generar el hash de la contraseña con el salt
contrasena_encriptada = bcrypt.hashpw(contrasena_original.encode('utf-8'), salt)

print(f"Contraseña original: {contrasena_original}")
print(f"Salt: {salt}")
print(f"Contraseña encriptada: {contrasena_encriptada.decode('utf-8')}")
