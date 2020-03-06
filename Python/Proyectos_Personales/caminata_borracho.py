#Caminata del borracho

import random as rn
import numpy as np
import matplotlib.pyplot as plt

def suceso_aleatorio(probabilidad):
    if rn.random() < probabilidad:
        return True
    else:
        return False

#%%

#Defino crear_camino
#genera una lista con un numero impar de posiciones a partir de un entereo

borracho = 0
vacio = 1
choque = -1

def crear_inicio(n_inicio):
    inicio = []
    i = 0
    ancho = 2*n_inicio + 1
    while i < ancho:
        inicio.append(vacio)
        i = i + 1
    #print(inicio)
    return inicio

#%%
    
#Defino colocar borracho
#coloca al borracho (1) en el centro del inicio
    
def colocar_borracho(inicio):
    inicio[int((len(inicio)-1)/2)] = borracho
    #print(inicio)
    #print('')
    return inicio

#%%

#Defino encontrar al borracho
#Busca al borracho en el camino y devuelve su posicion

def encontrar_borracho(inicio):
    i = 0
    while i < len(inicio):
        if inicio[i] == borracho:
            return i
        i = i + 1


#%%

#Defino dar un paso
#El borracho solo camina en diagonal
#Representamos un paso moviendo el 1 una posicion a la derecha o a la izuierda
#Ambas direcciones tienen la misma probabilidad

probabilidad_borracho = 0.5 #probabilidad de que camine a la derecha

def dar_paso(inicio,probabilidad):
    posicion = encontrar_borracho(inicio)
    inicio[posicion] = vacio
    if suceso_aleatorio(probabilidad_borracho):
        inicio[posicion] = vacio
        inicio[posicion + 1] = borracho
    else:
        inicio[posicion] = vacio
        inicio[posicion - 1] = borracho
    #print(inicio)
    #print('')
    return inicio


#Ahora quiero que si el borracho esta en la primera posicion y da un paso a la izquierda
#o si esta en la ultima posicio y da un paso a la derecha que deje de dar pasos
#y devuelva un mensaje de choque

'''   
def dar_paso_choque(inicio,probabilidad,choque)
'''

#%%

#Defino caminar
#hace que el borracho de un numero de pasos y da su ultima posicion

def caminar(inicio,probabilidad,pasos):
    i = 0
    while i < pasos:
        dar_paso(inicio,probabilidad)
        i = i + 1
    posicion = encontrar_borracho(inicio)
    return posicion

#%%

#Defino caminata
#Arma un camino, coloca al borracho y lo hace caminar

def caminata(n_inicio,probabilidad,pasos):
    inicio = crear_inicio(n_inicio)
    colocar_borracho(inicio)
    fin = caminar(inicio,probabilidad,pasos)
    return fin


#%%

def juntar_datos(n_inicio,probabilidad,pasos,repeticiones):
    datos = []
    i = 0
    while i < repeticiones:
        datos.append(caminata(n_inicio,probabilidad,pasos))
        i = i + 1
    return datos

#%%

#Ahora hagamos que rebote en las paredes
#Defino dar paso pero ahora puede rebotar en los bordes

probabilidad_borracho = 0.5 #probabilidad de que camine a la derecha

def dar_paso_rebote(inicio,probabilidad):
    posicion = encontrar_borracho(inicio)
    #print(inicio)
    #print('')
    if posicion == 0:
        inicio[posicion] = vacio
        inicio[posicion+1] = borracho
    elif posicion == len(inicio)-1:
        inicio[posicion] = vacio
        inicio[posicion-1] = borracho
    else:
        if suceso_aleatorio(probabilidad_borracho):
            inicio[posicion] = vacio
            inicio[posicion + 1] = borracho
        else:
            inicio[posicion] = vacio
            inicio[posicion - 1] = borracho
    return inicio

#Adapto las siguientes funciones

#Caminar:

def caminar_rebote(inicio,probabilidad,pasos):
    i = 0
    while i < pasos:
        dar_paso_rebote(inicio,probabilidad)
        i = i + 1
    posicion = encontrar_borracho(inicio)
    return posicion

#Caminata:

def caminata_rebote(n_inicio,probabilidad,pasos):
    inicio = crear_inicio(n_inicio)
    colocar_borracho(inicio)
    fin = caminar_rebote(inicio,probabilidad,pasos)
    return fin

#Juntar datos:

def juntar_datos_rebote(n_inicio,probabilidad,pasos,repeticiones):
    datos = []
    i = 0
    while i < repeticiones:
        datos.append(caminata_rebote(n_inicio,probabilidad,pasos))
        i = i + 1
    return datos

#%%

#Juguemos


n_inicio = 50
n_pasos = 100
proba = 0.5
rep = 1000

datos = juntar_datos(n_inicio,proba,n_pasos,rep)

plt.figure()
plt.grid()
plt.hist(datos,n_inicio,label='Borracho no rebota')
plt.legend()
plt.xlabel('Posicion Final')
plt.ylabel('Cantidad de veces que llego')

datos = juntar_datos_rebote(n_inicio,proba,n_pasos,rep)

plt.hist(datos,n_inicio,label='Borracho rebota')
plt.legend()
plt.xlabel('Posicion final')
plt.ylabel('Cantidad de veces que llego')

