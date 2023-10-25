from django.urls import path, include
from .views import UsuarioView, VehicleView, UsuarioLoginView, UsuarioSearchView, VehicleSearchView


urlpatterns = [
    path('usuario/', UsuarioView.as_view(), name='usuario_list'),
    path('login/',UsuarioLoginView.as_view(), name='usuario_login'),
    path('search/<str:token>',UsuarioSearchView.as_view(), name='usuario_search'),
    path('usuario/<str:token>', UsuarioView.as_view(), name='usuario_desc'),
    path('vehicle/<str:token>', VehicleView.as_view(), name='vehicle_desc'),
    path('vehicle/<str:token>/<str:placa>', VehicleView.as_view(), name='vehicle_list'),
    path('searchvehicle/<str:token>/<str:placa>', VehicleSearchView.as_view(), name='vehicle_search')
]
