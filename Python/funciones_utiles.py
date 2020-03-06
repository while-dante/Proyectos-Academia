###Funciones Utiles###

#Esta en
#Se fija si un elemento esta en una lista
#Pide un elemento y una lista, devuelve True o False

def esta_en(elemento, lista):
    i = 0
    while i < len(lista):
        if lista[i] == elemento:
            return True
        i = i + 1
    return False

#%%

#Suceso aleatorio
#Pide un numero entre 0 y 1, devuelve un booleano
#Requiere la biblioteca randdom

import random as rn

def suceso_aleatorio(probabilidad):
    return rn.random() <= probabilidad

#%%
        
#Intervalo por particiones
#Genera una lista de valores entre un numero inicial y uno final 
#con el numero de particiones deseado
        
def intervalo_particiones(inicio,fin,particiones):
    intervalo = []
    referencia = inicio
    i = 0
    while i <= particiones:
        intervalo.append(inicio)
        i = i + 1
        inicio = inicio + (fin-referencia)/particiones
    return intervalo

#%%
#Intervalo por longitud
#Genera una lista de valores entre un numero inicial y uno final 
#dando pasos de una longitud dad

def intervalo_longitud(inicio,fin,longitud):
    intervalo = []
    i = 0
    while i <= abs(fin/longitud):
        intervalo.append(inicio)
        i = i + 1
        inicio = inicio + longitud
    return intervalo

#%%

#Encontrar elemento
#Busca un elemento en una lista y da las posiciones donde esta
#Pide una lista y un elemento, devuelve una lista de enteros

def encontrar_elemento(elemento,lista):
    posiciones = []
    i = 0
    while i < len(lista):
        if lista[i] == elemento:
            posiciones.append(i)
        i = i + 1
    if len(posiciones) == 0:
        return 'No se encontro <'+str(elemento)+'> en la lista.'
    else:
        return posiciones

#%%

#Orden aleatorio
#Ordena de forma al azar enteros entre un entero y otro (incluyendo esos dos)
#Pide dos numero enteros, devuelve una lista de enteros
#Requiere la biblioteca random
#Usa la funcion esta_en

def orden_aleatorio(entero_inferior,entero_superior):
    orden = []
    for i in range(entero_inferior,entero_superior+1):
        orden.append(i)
        
    rn.shuffle(orden)
    print(orden)
    return orden
    '''
    if entero_inferior > entero_superior:
        return 'Limites al revez'
    largo = entero_superior - entero_inferior + 1
    numero = rn.randint(entero_inferior,entero_superior)
    orden = [numero]
    while len(orden) < largo:
        numero = rn.randint(entero_inferior,entero_superior)
        if not esta_en(numero,orden):
            orden.append(numero)
    return orden
'''
#%%

#Contador de si­mbolos
#Cuenta la cantidad de un dado simbolo en una palabra o nimero
#Pide una variable y devuelve un int con la cantidad de veces que aparece el simbolo
'''
def cont_caracter(caracter,secuencia):
    secuencia = leni(secuencia)
    caracter = str(caracter)
    contador = 0
    i = 0
    while i < len(secuencia):
        j = 0
        while j < len(secuencia[i]):
            if (secuencia[i])[j] == caracter:
                contador = contador + 1
            j = j + 1
        i = i + 1
    return contador
                

caracter = 'a'
secuencia = ['papa','calabaza','a',1037]
print(cont_caracter(caracter,secuencia))
'''
#%%

#Las ocho coordenadas que rodean a una

def mis_vecinos(coord_centro):
    coord1 = (coord_centro[0]-1,coord_centro[1]-1)
    coord2 = (coord_centro[0]-1,coord_centro[1])
    coord3 = (coord_centro[0]-1,coord_centro[1]+1)
    coord4 = (coord_centro[0],coord_centro[1]+1)
    coord5 = (coord_centro[0]+1,coord_centro[1]+1)
    coord6 = (coord_centro[0]+1,coord_centro[1])
    coord7 = (coord_centro[0]+1,coord_centro[1]-1)
    coord8 = (coord_centro[0],coord_centro[1]-1)
    coordenadas_vecinas = [coord1,coord2,coord3,coord4,coord5,coord6,coord7,coord8]
    return coordenadas_vecinas

#%%

#Buscar adyacente
#Busca un tipo de casilla en las coordenadas vecinas de la ingresada
#Devuelve una lista con la primera coordenada que coincide o vacia si no hay

def buscar_adyacente(tablero,coord_centro,objetivo):
    adyacente = []
    vecinos = mis_vecinos(coord_centro)
    
    for coordenada in vecinos:
        if tablero[coordenada] == objetivo:
            adyacente.append(coordenada)
            return adyacente
    return adyacente

#%%
    
#lenificador
#Convierte todos los numeros (int,float) a str
#Pide una lista y devuelve una lista

''' 
def leni(lista):
    i = 0
    while i <len(lista):
        if type(lista[i]) == int or type(lista[i]) == float:
            lista[i] = str(lista[i])
        i = i + 1
    return lista
'''

def leni(lista):
    i = 0
    while i <len(lista):
        lista[i] = str(lista[i])
        i = i + 1
    return lista

#Prueba
a = [113,'batata',3.14,'zapallo']

print('lista original:', a)
print('lista lenificada:', leni(a))

#%%
 
    
    
    
    