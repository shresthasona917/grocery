# Generated by Django 4.2 on 2023-04-11 13:09

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('groceryproducts', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='category',
            name='category_img',
            field=models.FileField(default=None, max_length=250, null=True, upload_to='category_images/'),
        ),
    ]