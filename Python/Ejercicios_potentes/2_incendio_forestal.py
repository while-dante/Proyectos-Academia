import random as rn
import matplotlib.pyplot as plt
import numpy as np
plt.ion()

###Bosque
#Tiene n posiciones
#Representamos el estado de una posicion del bosque con:

vacio = 0
arbol = 1
fuego = -1

###Etapa de un bosque durante doce meces

#1_ Primavera: hay una proabilidad (p) de que nazca un arbol

#2_ Caida de rayos: hay una probabilidad (f) de que caiga un rayo en una posicion
# Si cae un rayo donde habia un arbol (1), ese arbol se incendia (-1)

#3_ Incendios: los arboles prendidos fuego (-1) extienden el fuego a los arboles (1) vecinos

#4_ Limpieza: los arboles prendidos fuego (-1) dejan un espacio vacio (0)

#%%

#Bosque vacio
#Solo tiene espacios vacios (0)

def generar_bosque_vacio(n_posiciones):
    bosque_vacio = []
    i = 0
    while i < n_posiciones:
        bosque_vacio.append(vacio)
        i = i + 1
    #print(bosque_vacio)
    #print('')
    return bosque_vacio

'''
#Prueba
n0 = 10
bosque0 = generar_bosque_vacio(n0)
print('Bosque vacio de prueba:', bosque0)
'''

#Bosque limpio
#Tiene espacios vacios (0) y arboles (1)

def generar_bosque_limpio(n_posiciones):
    bosque_limpio = []
    i = 0
    while i < n_posiciones:
        bosque_limpio.append(rn.randint(0,1))
        i = i + 1
    return bosque_limpio

#Bosque quemado
#Tiene espacios vacios (0), arboles (1) y arboles prendidos fuego (-1)

def generar_bosque_quemado(n_posiciones):
    bosque_quemado = []
    i = 0
    while i < n_posiciones:
        bosque_quemado.append(rn.randint(-1,1))
        i = i + 1
    return bosque_quemado

#%%

###Defino funciones para representar las etapas:

#Defino la funcion brotes
#Genera un arbol (1) en cada celda vacia (0) con una probabilidad p

def suceso_aleatorio(probabilidad):
    if rn.random() <= probabilidad:
        return True
    else:
        return False

def brotes(bosque,probabilidad_brote):
    i = 0
    while i < len(bosque):
        if bosque[i] == vacio and suceso_aleatorio(probabilidad_brote):
            bosque[i] = arbol
        i = i + 1
    #print(bosque)
    #print('')
    return bosque

'''
#Prueba
n = 10
bosque0 = generar_bosque_vacio(n)
print('Bosque vacio:',bosque0)
print('')
p_brote = 0.6
bosque1 = brotes(bosque0,p_brote)
print('Bosque brotado:',bosque_brotado)
'''
#%%

#Defino la funcion cuantos
#Toma un bosque y un tipo de celda y devuelve la cantidad de ese tipo en el bosque
    
def cuantos(bosque,tipo_celda):
    if tipo_celda != -1 and tipo_celda != 0 and tipo_celda != 1:
        mensaje = 'Tipo de celda no existente'
        return mensaje
    else:
        total = bosque.count(tipo_celda)
        return total

'''
#Prueba
n = 10
p_brote = 0.6
bosque0 = brotes(generar_bosque_vacio(n),p_brote)
print('Bosque:',bosque0)
cantidad_prueba = cuantos(bosque0,arbol)
print(cantidad_prueba, 'arboles en el bosque')
'''
#%%

#Defino la funcion rayos
#Prende fuego (-1) los arboles (1) con una probabilidad p
    
def rayos(bosque,probabilidad_rayo):
    i = 0
    while i < len(bosque):
        if bosque[i] == arbol and suceso_aleatorio(probabilidad_rayo):
            bosque[i] = fuego
        i = i + 1
    #print(bosque)
    #print('')
    return bosque

'''
#Prueba
n = 10
bosque0 = generar_bosque_vacio(n)
print('Bosque vacio:',bosque0)
p_brote = 0.6
bosque1 = brotes(bosque0,p_brote)
print('Bosque brotado:',bosque1)
p_rayo = 0.2
bosque2 = rayos(bosque1,p_rayo)
print('Cayeron rayos:',bosque2)
'''
#%%

#Defino la funcion propagacion
#Busca arboles prendidos fuego (-1) y enciende a sus vecinos (1)

def propagacion(bosque):
    #print(bosque)
    i = 0
    j = len(bosque) - 1
    while i < len(bosque) - 1:
        if bosque[i] == fuego and bosque[i+1] == arbol:
            bosque[i+1] = fuego
            #print(bosque)
        i = i + 1
    while j > 0:
        if bosque[j] == fuego and bosque[j-1] == arbol:
            bosque[j-1] = fuego
            #print(bosque)
        j = j - 1
    #print(bosque)
    #print('')
    return bosque

'''
#Prueba
n = 20
bosque0 = generar_bosque_vacio(n)
print('Campito:',bosque0)
print('')
p_brote = 0.6
bosque1 = brotes(bosque0,p_brote)
print('Bosquecito:',bosque1)
print('')
p_rayo = 0.2
bosque2 = rayos(bosque1,p_rayo)
print('Tormenta:',bosque2)
print('')
bosque3 = propagacion(bosque2)
print('Incendio:',bosque3)
'''
#%%

#Defino la funcion limpieza
#Busca arboles prendidos fuego (-1) y los reemplaza por un espacio vacio (0)

def limpieza(bosque):
    i = 0
    while i < len(bosque):
        if bosque[i] == -1:
            bosque[i] = 0
        i = i + 1
    #print(bosque)
    #print('')
    return bosque

'''
#Prueba
n = 20
bosque0 = generar_bosque_vacio(n)
print('Campito:',bosque0)
print('')
p_brote = 0.6
bosque1 = brotes(bosque0,p_brote)
print('Bosquecito:',bosque1)
print('')
p_rayo = 0.2
bosque2 = rayos(bosque1,p_rayo)
print('Tormenta:',bosque2)
print('')
bosque3 = propagacion(bosque2)
print('Incendio:',bosque3)
print('')
bosque4 = limpieza(bosque3)
print('Lo que queda:',bosque4)
'''
#%%

#Defino la funcion incendio forestal
#Repite el ciclo de un bosque n veces y retorna el promedio de arboles que sobreviven

def incendio_forestal(posiciones,proba_brote,proba_rayo,repeticiones):
    t = 0
    supervivientes = 0
    #Primero genera un bosque vacio
    bosque = generar_bosque_vacio(posiciones)
    while t < repeticiones:
        brotes(bosque,proba_brote) #crecen arboles
        rayos(bosque,proba_rayo) #caen rayos
        propagacion(bosque) #el fuego se extiende
        limpieza(bosque) #se limpia el bosque
        supervivientes = supervivientes + cuantos(bosque,arbol) #cuenta los que quedan
        t = t + 1
    promedio = supervivientes/repeticiones
    return promedio

'''
#Prueba
largo_bosque = 100
proba_brote = 0.6
proba_rayo = 0.2
rep = 5000

resultado = incendio_forestal(largo_bosque,proba_brote,proba_rayo,rep)

print('Promedio de supervivientes:',resultado)
'''
#%%

#Valor optimo de probabilidad de brote

#Me hace una lista de probabilidades de 0 a 1 equiespaciadas

def generar_probas_brote(particiones):
    probas_brote = []
    i = 0
    j = 0
    while i <= particiones:
        probas_brote.append(j)
        i = i + 1
        j = j + 1/particiones
    return probas_brote

#Me hago una lista de los promedios correspondientes a esas probas

def generar_promedios(posiciones,probas_brote,proba_rayo,repeticiones):
    promedios = []
    i = 0
    while i < len(probas_brote):
        promedios.append(incendio_forestal(posiciones,probas_brote[i],proba_rayo,repeticiones))
        i = i + 1
    return promedios

#%%
    
#Prueba
largo_bosque = 100
proba_rayo20 = 0.2
proba_rayo50 = 0.5
proba_rayo80 = 0.8
particiones = 100
probas_brote = generar_probas_brote(particiones)
rep = 100

promedios20 = generar_promedios(largo_bosque,probas_brote,proba_rayo20,rep)
promedios50 = generar_promedios(largo_bosque,probas_brote,proba_rayo50,rep)
promedios80 = generar_promedios(largo_bosque,probas_brote,proba_rayo80,rep)

plt.plot(probas_brote,promedios20,'ro',label='Probabilidad de rayo del '+str(proba_rayo20*100)+'%')
plt.plot(probas_brote,promedios50,'mo',label='Probabilidad de rayo del '+str(proba_rayo50*100)+'%')
plt.plot(probas_brote,promedios80,'yo',label='Probabilidad de rayo del '+str(proba_rayo80*100)+'%')
plt.grid()
plt.xlabel('Probabilidad de brote')
plt.ylabel('Produccion de arboles')
plt.legend()

