from rest_framework.viewsets import ModelViewSet
from user.models import User
from user.api.serializers import UserSerializer

class UserApiViewSet(ModelViewSet):
    serializer_class = UserSerializer
    queryset = User.objects.all()