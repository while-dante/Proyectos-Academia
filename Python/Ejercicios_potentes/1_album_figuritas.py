#Importo bibliotecas y funciones utiles

import numpy as np
import random as rn

def esta_en(elemento, lista):
    i = 0
    while i < len(lista):
        if lista[i] == elemento:
            return True
        i = i + 1
    return False
#%%

###Llenemos albums de figuritas

'''¿Cuantas figuritas hay que comprar hasta rellenar el album?'''


#Album con 669 figuritas
#Cada figurita se imprime en cantidades iguales y se distribulle aleatoriamente
#Cada paquete trae 5 figuritas


###PRIMERO COMPRAMOS LAS FIGURITAS DE A UNA

#Creo el album vacio (o sea lleno de ceros)
album = []

i = 0
while i < 500:
    album.append(0)
    i = i + 1

#Mientras el album no este lleno (que ya no tenga ceros) compro una figurita mas

print('completemos el album')

figuritas_compradas = 0

while esta_en(0,album):
    album[rn.randint(0,len(album) - 1)] = 1
    figuritas_compradas = figuritas_compradas + 1

print('album completo')

print('Figuritas compradas:',figuritas_compradas)

#%%

#Simular comprar una figurita

def comprar_una_figu(figus_total):
    figu = rn.randint(1,figus_total)
    #print('Compre la',figu)
    return figu

#%%    

#Simular compra hasta llenar el album se llene y dar la cantidad de compras

def cuantas_figus(figus_total):
    figuritas_compradas = 0
    album = []
    i = 0
    while i < figus_total:
        album.append(0)
        i = i + 1
    #print(album)
    while esta_en(0,album):
        album[comprar_una_figu(figus_total) - 1] = 1
        figuritas_compradas = figuritas_compradas + 1
        #print(album)
    #print('Compre',figuritas_compradas,'figuritas')
    return figuritas_compradas

figus_total = 500

figuritas = cuantas_figus(figus_total)

print('Compre', figuritas, 'figuritas en total.')

#%%

#Ahora lo repetimos

n_repeticiones = 100

figus_total = 500

def repetir_album(n_repeticiones,figus_total):
    i = 0
    resultados = []

    while i < n_repeticiones:
        resultados.append(cuantas_figus(figus_total))
        i = i + 1

    promedio = np.mean(resultados)
    return promedio

resultado = repetir_album(n_repeticiones,figus_total)
print('Promedio de compra:',resultado)

#%%

### AHORA CON PAQUETES###

#Compro de a cinco en vez de a una

#Para representar un paquete voy a usar una lista

#Un paquete de 5 figuritas de un album de 669

paquete = []

i = 0
while i < 5:
    paquete.append(comprar_una_figu(669))
    i = i + 1

print(paquete)

#%%

#Arma un paquete de una dada cantidad de figuritas para un album de una cantidad de figuritas totales

def generar_paquete(figus_total,figus_paquete):
    paquete = []
    i = 0
    while i < figus_paquete:
        paquete.append(comprar_una_figu(figus_total))
        i = i + 1
    #print('')
    #print('Compre el paquete:',paquete)
    return paquete

#%%

#Quiero saber cuantos paquetes tengo que comprar para llenar un album

def cuantos_paquetes(figus_total,figus_paquete):
    paquetes_comprados = 0
    album = []
    i = 0
    while i < figus_total:
        album.append(0)
        i = i + 1
    #print(album)
    while esta_en(0,album):
        j = 0
        paquete = generar_paquete(figus_total,figus_paquete)
        while j < figus_paquete:
            album[paquete[j] - 1] = 1
            j = j + 1
        paquetes_comprados = paquetes_comprados + 1
        #print('')
        #print(album)
    #print('Compre',paquetes_comprados,'paquetes en total')
    return paquetes_comprados

figus_total = 669
figus_paquete = 5

compras = cuantos_paquetes(figus_total,figus_paquete)
print('Compre',compras,'paquetes en total.')

#%%

#Ahora lo repetimos

def repetir_album_paquetes(n_repeticiones,figus_total,figus_paquete):
    i = 0
    resultados = []

    while i < n_repeticiones:
        resultados.append(cuantos_paquetes(figus_total,figus_paquete))
        i = i + 1
    return resultados


def repetir_album_paquetes_promedio(n_repeticiones,figus_total,figus_paquete):
    i = 0
    resultados = []

    while i < n_repeticiones:
        resultados.append(cuantos_paquetes(figus_total,figus_paquete))
        i = i + 1
    promedio = np.mean(resultados)
    return promedio

'''
n_repeticiones = 1000

figus_total = 200

figus_paquete = 5

resultado = repetir_album_paquetes(n_repeticiones,figus_total,figus_paquete)

resultado_promedio = repetir_album_paquetes_promedio(n_repeticiones,figus_total,figus_paquete)


print('Paquetes en cada repeticion:',resultado)
print('Promedio:',resultado_promedio)
'''

#%%

def Probabilidad_de_llenar_el_album(n_repeticiones,figus_total,figus_paquete,paquetes):
    i = 0
    contador = 0
    resultados = repetir_album_paquetes(n_repeticiones,figus_total,figus_paquete)
    while i < n_repeticiones:
        if resultados[i] <= paquetes:
            contador = contador + 1
        i = i + 1
    P = (contador/n_repeticiones)
    return P

n_repeticiones = 10000

figus_total = 669

figus_paquete = 5

paquetes = 850

proba = Probabilidad_de_llenar_el_album(n_repeticiones,figus_total,figus_paquete,paquetes)
print('Probabilidad:',proba)

#%%


