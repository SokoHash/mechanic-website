from django.db import models

# Create your models here.
class Usuario(models.Model):
    email = models.EmailField(max_length=30, unique=True)
    id_card = models.CharField(max_length=30)
    phone = models.IntegerField()
    password = models.CharField(max_length=30)
    token_user = models.CharField(max_length=50)
    is_admin = models.BooleanField(default=False)

class Vehicle(models.Model):
    placa = models.CharField(max_length=100)
    vehiculo = models.CharField(max_length=100)
    tipo_arreglo = models.CharField(max_length=100)
    description = models.TextField(max_length=100)
    mecanico = models.CharField(max_length=100)
    userfk = models.ForeignKey(Usuario,null=True,on_delete=models.CASCADE)

