from rest_framework import viewsets
from .models import Usuario, Vehicle
from django.http.response import JsonResponse
from django.utils.decorators import method_decorator
from django.views import View
from django.views.decorators.csrf import csrf_exempt
from uuid import uuid4
from django.contrib.auth.hashers import make_password, check_password

import json
# Create your views here.

class UsuarioSearchView(View):
    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, token=""):
        """Return data user as a admin"""
        jd = json.loads(request.body)
        usuarios = list(Usuario.objects.filter(token_user=token).values())
        if len(usuarios) > 0:
            try:
                if Usuario.objects.get(token_user='93dc89ce-c715-4b1b-9990-d3a7a7eb521c'):
                    usersearch = list(Usuario.objects.filter(email=jd['email']).values())
                    datos = {'uservalue': usersearch}
            except:
                datos = {'message': "You don't have permission for this action..."}
        else:
            datos = {'message': "User not found..."}
        return JsonResponse(datos)

class UsuarioLoginView(View):
    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request):
        """Validate email and password date into database"""
        jd = json.loads(request.body)
        usuarios = list(Usuario.objects.values())
        if len(usuarios) > 0:
            if (jd['email']=='aurora@run.com' and '123456789' == jd['password']):
                usuarios = list(Usuario.objects.filter(email=jd['email']).values())
                adminvalue = usuarios[0]['token_user']
                datos = {'message': 'admin', 'adminvalue': adminvalue}
            else:
                try:
                    obj = Usuario.objects.get(email=jd['email'])
                    if (Usuario.objects.get(email=jd['email']) and check_password(jd['password'], obj.password)):
                        uservalue = usuarios[0]['token_user']
                        datos = {'message': 'user', 'uservalue': uservalue}
                    else:
                        datos = {'message': "Bad credentials"}
                except:
                    datos = {'message': "Bad credentials"}
        else:
            datos = {'message': "User not found..."}


        return JsonResponse(datos)

class UsuarioView(View):
    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def get(self, request, token=""):
        """Return all user data"""
        usuarios = list(Usuario.objects.filter(token_user=token).values())
        if len(usuarios) > 0:
            uservalue = usuarios[0]
            datos = {'message': "Success", 'uservalue': uservalue}
        else:
            datos = {'message': "You are not logged in..."}
        return JsonResponse(datos)

    def post(self, request):
        """Create User"""
        jd = json.loads(request.body)
        password_crypt = make_password(jd['password'])
        Usuario.objects.create(email=jd['email'], id_card=jd['id_card'], phone=jd['phone'], password=password_crypt, token_user=str(uuid4()))
        datos = {'message': "Success"}
        return JsonResponse(datos)

    def put(self, request, token):
        """Update user"""
        jd = json.loads(request.body)
        userList = list(Usuario.objects.filter(token_user=token).values())
        if len(userList) > 0:
            usuarios = Usuario.objects.get(token_user=token)
            usuarios.email = jd['email']
            usuarios.id_card = jd['id_card']
            usuarios.phone = jd['phone']
            usuarios.password = make_password(jd['password'])
            usuarios.save()
            datos = {'message': "Success"}
        else:
            datos = {'message': "User not found..."}
        return JsonResponse(datos)

    def delete(self, request, token):
        """Delete user"""
        userList = list(Usuario.objects.filter(token_user=token).values())
        if len(userList) > 0:
            Usuario.objects.filter(token_user=token).delete()
            datos = {'message': "Success"}
        else:
            datos = {'message': "User not found..."}
        return JsonResponse(datos)

class VehicleSearchView(View):
    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def get(self, request, token, placa):
        """Search for a particular vehicule"""
        usuarios = list(Usuario.objects.filter(token_user=token).values())
        if len(usuarios) > 0:
            vehicleupdate = list((Vehicle.objects.filter(placa=placa).values()))
            if len(vehicleupdate) > 0:
                datos = {'uservalue': vehicleupdate}
            else:
                datos = {'message': "Not vehicle was found"}
        else:
            datos = {'message': "You don't have credentials for searching a user"}
        return JsonResponse(datos)


class VehicleView(View):
    @method_decorator(csrf_exempt)
    def dispatch(self, request, *args, **kwargs):
        return super().dispatch(request, *args, **kwargs)

    def post(self, request, token):
        """Create a vehicle from user"""
        userList = list(Usuario.objects.filter(token_user=token).values())
        if len(userList) > 0:
            instanceUser = Usuario.objects.get(token_user=token)
            jd = json.loads(request.body)
            Vehicle.objects.create(placa=jd['placa'], vehiculo=jd['vehiculo'], tipo_arreglo=jd['tipo_arreglo'], description=jd['description'], mecanico=jd['mecanico'], userfk=instanceUser)
            datos = {'message': "Success"}
            return JsonResponse(datos)

    def get(self, request, token=""):
        """Get all vehicles from User"""
        usuarios = list(Usuario.objects.filter(token_user=token).values())
        if len(usuarios) > 0:
            instanceUser = Usuario.objects.get(token_user=token)
            vehicle = list(Vehicle.objects.filter(userfk=instanceUser).values())
            if len(vehicle) > 0:
                datos = {'uservalue': vehicle}
            else:
                datos = {'message': "Not vehicle was found"}
        else:
            datos = {'message': "User not found"}
        return JsonResponse(datos)

    def put(self, request, token, placa):
        """Update vehicle from user"""
        jd = json.loads(request.body)
        userList = list(Usuario.objects.filter(token_user=token).values())
        if len(userList) > 0:
            instanceUser = Usuario.objects.get(token_user=token)
            try:
                vehicleupdate = Vehicle.objects.filter(userfk=instanceUser).get(placa=placa)
                vehicleupdate.placa = jd['placa']
                vehicleupdate.vehiculo = jd['vehiculo']
                vehicleupdate.tipo_arreglo = jd['tipo_arreglo']
                vehicleupdate.description = jd['description']
                vehicleupdate.mecanico = jd['mecanico']
                vehicleupdate.save()
                datos = {'message': "Success"}
            except:
                datos = {'message': "Not vehicle was found"}
        else:
            datos = {'message': "Usuario not found..."}
        return JsonResponse(datos)

    def delete(self, request, token, placa):
        """Delete vehicle from user"""
        userList = list(Usuario.objects.filter(token_user=token).values())
        if len(userList) > 0:
            instanceUser = Usuario.objects.get(token_user=token)
            try:
                vehicleupdate = Vehicle.objects.filter(userfk=instanceUser).get(placa=placa).delete()
                datos = {'message': "Success"}
            except:
                datos = {'message': "Not vehicle was found"}
        else:
            datos = {'message': "Usuario not found..."}
        return JsonResponse(datos)