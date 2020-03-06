#Clase 2 (3 de diciembre)

#Hacer una lista de 100 elementos y dos funciones
#Una que imprima la lista de atras para adelante y otra que imprima los elementos cada dos


lista_de_100 = []

i = 1

while i <= 100:
    lista_de_100.append(i)
    i = i + 1


def imprimir_inverso(una_lista):
    i = 0
    while i < len(una_lista):
        print(una_lista[len(una_lista) - (i + 1)])    
        i = i + 1


def imprimir_cada_dos(una_lista):
    i = 0
    while i < len(una_lista)/2:
        print(una_lista[2*i])
        i = i + 1

imprimir_inverso(lista_de_100)
imprimir_cada_dos(lista_de_100)

#%%

lista_10 = []

i = 1

while i <=10:
    lista_10.append(i)
    i = i + 1

j = 0
l = 1

while j < len(lista_10):
    while l <= lista_10[j]:
        print(lista_10[j])
        l = l + 1
    l = 1
    j = j + 1

