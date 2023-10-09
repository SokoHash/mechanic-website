from rest_framework.routers import DefaultRouter
from user.api.views import UserApiViewSet

router_posts = DefaultRouter()

router_posts.register(prefix='post', basename='post', viewset=UserApiViewSet)