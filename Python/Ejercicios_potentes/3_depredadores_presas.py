### Depredadores y Presas

import numpy as np
import random as rn
import time

# Representamos Leones y Antilopes
# No importa el sexo  y asumimos que todos tienen los recursos para subsistir
# Representamos el terreno con una matriz
# Valle rodeado de montañas

# Separamos en fases de Comer, Reproducirse y Moverse
# Si un leon ve un antilope en su vecindad en la fase de comer el antilope es comido
# Los elemento de la matriz son (i,j) i = fila, j = columna

#%%
'''
#Generar terreno
#Armar una matriz cuadrada, hacemos lista de listas

tablero = np.repeat('',7*9).reshape(7,9)

#lo vemos
print(tablero)
#accedemos a un elemento por su fila y columna
print('La posicion (1,2) tiene el elemento:', tablero[(1,2)])
#accedemos a las dos dimensiones del tablero
print('Mi tablero tiene', tablero.shape[0],'filas y', tablero.shape[1],'columnas.')
'''
#%%

#Generar tablero

def generar_tablero(alto,ancho):
    montaña = 'M'
    suelo = ' '
    tablero = np.repeat(suelo,alto*ancho).reshape(alto,ancho)
    
    for indice_fila in range(ancho):
        tablero[(0,indice_fila)] = montaña
        tablero[(alto-1,indice_fila)] = montaña

    for indice_columna in range(alto):
        tablero[(indice_columna,0)] = montaña
        tablero[(indice_columna,ancho-1)] = montaña

    return tablero

#%%
    
def print_tablero(tablero):
    time.sleep(0.1)
    n_fila = tablero.shape[0]
    n_columna = tablero.shape[1]
    grafico = tablero.copy()
    for i in range(0,n_fila):
        for j in range(0,n_columna):
            coordenada_actual = (i,j)
            if grafico[(i,j)] == "L":
                grafico[(i,j)] = chr(0x0001F981)
            if grafico[(i,j)] == "A":
                grafico[(i,j)] = chr(0x0001F98C)
            if grafico[(i,j)] == "M":
                grafico[(i,j)] = chr(0x000026F0)
            if grafico[(i,j)] == " ":
                grafico[(i,j)] = chr(0x0001F331)
            print(grafico[coordenada_actual], end='|')
        print()
    print()


#%%
'''
#Vamos a poblar el tablero

fil = [1,2,3,3,1]
col = [3,1,1,3,2]

tipo = [antilope, antilope, antilope, antilope, leon]

#Asignamos a nuestro tablero

for i in range(len(tipo)):
    tablero[(fil[i],col[i])] = tipo[i]

print(tablero)
'''
#%%

#Hagamos que nuestros animalitos vean su entorno,
#o sea las coordenadas que los roodean

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
'''
#Para recorrel el tablero actual lo hacemos por fila de izquierda a derecha
#No se recorren los bordes asi que vamos de (1,1) a (filas-2,columnas-2)

n_fila = tablero.shape[0]
n_columna = tablero.shape[1]

for i in range(1,n_fila-1):
    for j in range(1,n_columna-1):
        coordenada_actual = (i,j)
        #print(coordenada_actual)
'''
#%%

#Fase de alimentacion
#Recorre el tablero, cuando llega a un leon, este buca un antilope
#Si lo encuentra se lo come y se pone en su posicion

def fase_alimentacion(tablero):
    leon = 'L'
    antilope = 'A'
    suelo = ' '
    
    n_fila = tablero.shape[0]
    n_columna = tablero.shape[1]
    
    for i in range(1,n_fila-1):
        for j in range(1,n_columna-1):
            coordenada_actual = (i,j)
            if tablero[coordenada_actual] == leon:
                adyacente = buscar_adyacente(tablero,coordenada_actual,antilope)
                if len(adyacente) > 0:
                    tablero[coordenada_actual] = suelo
                    tablero[adyacente[0]] = leon
                    print_tablero(tablero)
    return tablero
    
'''
tablero = generar_tablero(filas,columnas,suelo,montaña)

fil = [1,2,3,3,1]
col = [3,1,1,3,2]

tipo = [antilope, antilope, antilope, antilope, leon]

for i in range(len(tipo)):
    tablero[(fil[i],col[i])] = tipo[i]
    

print(tablero)
print('')
print(fase_alimentacion(tablero))
'''
#%%

#Fase de reproduccion
#Recorre el tablero buscando animales, cuando encuentra uno busca a otro
#de su misma especie y si lo encuentra busca la primera posicion vacia para poner otro

def fase_reproduccion(tablero):
    n_fila = tablero.shape[0]
    n_columna = tablero.shape[1]
    leon = 'L'
    antilope = 'A'
    suelo = ' '
    for i in range(1,n_fila-1):
        for j in range(1,n_columna-1):
            coordenada_actual = (i,j)
            if tablero[coordenada_actual] == antilope:
                adyacente = buscar_adyacente(tablero,coordenada_actual,antilope)
                cria = buscar_adyacente(tablero,coordenada_actual,suelo)
                if len(adyacente) > 0 and len(cria) > 0:
                    tablero[cria[0]] = antilope
                    print_tablero(tablero)
            elif tablero[coordenada_actual] == leon:
                adyacente = buscar_adyacente(tablero,coordenada_actual,leon)
                cria = buscar_adyacente(tablero,coordenada_actual,suelo)
                if len(adyacente) > 0 and len(cria) > 0:
                    tablero[cria[0]] = leon
                    print_tablero(tablero)
    return tablero
            
'''
tablero = generar_tablero(filas,columnas,suelo,montaña)

fil = [1,2,3,3,1]
col = [3,1,1,3,2]

tipo = [antilope, antilope, antilope, antilope, leon]

for i in range(len(tipo)):
    tablero[(fil[i],col[i])] = tipo[i]

print(fase_reproduccion(tablero))
'''
#%%

#Fase de movimiento
#Recorre el tablero buscando animales, cuando encuentra uno busca un espacio vacio adyacente
#Si lo encuentra mueve al animal actual a esa posicion

def fase_mover(tablero):
    n_fila = tablero.shape[0]
    n_columna = tablero.shape[1]
    leon = 'L'
    antilope = 'A'
    suelo = ' '
    for i in range(1,n_fila-1):
        for j in range(1,n_columna-1):
            coordenada_actual = (i,j)
            if tablero[coordenada_actual] == antilope or tablero[coordenada_actual] == leon:
                lugar = buscar_adyacente(tablero,coordenada_actual,suelo)
                if len(lugar) > 0:
                    tablero[lugar[0]] = tablero[coordenada_actual]
                    tablero[coordenada_actual] = suelo
                    print_tablero(tablero)                    
    return tablero

'''
tablero = generar_tablero(filas,columnas,suelo,montaña)
print(tablero)
print('')

fil = [1,2,3,3,1]
col = [3,1,1,3,2]

tipo = [antilope, antilope, antilope, antilope, leon]

for i in range(len(tipo)):
    tablero[(fil[i],col[i])] = tipo[i]

print(tablero)
print('')

print(fase_mover(tablero))
print('')
print(fase_alimentacion(tablero))
'''
#%%

#Evolucion
#Consiste en las tres fases una detras de otra

def evolucionar(tablero):
    fase_alimentacion(tablero)
    fase_reproduccion(tablero)
    fase_mover(tablero)
    return tablero

def evolucionar_tiempo(tablero,tiempo_limite):
    i = 0
    while i < tiempo_limite:
        evolucionar(tablero)
        i = i + 1
        #print('Fin del ciclo',i)
        #print('')
    return tablero

#%%
'''
###VAMOS A TESTEAR
    
filas = 6 #4 casillas de alto
columnas = 8 #6 casillas de ancho

tablero = generar_tablero(filas,columnas)
print(tablero)
print('')

x = [2,3,4,4,2]
y = [2,3,3,5,5]

tipos = ['A','A','A','L','L']

for i in range(len(tipos)):
    tablero[(x[i],y[i])] = tipos[i]

print(tablero)
print('')

print(evolucionar_tiempo(tablero,2))
'''
#%%

#Ahora quiero que cuente los antilopes despues de cada ciclo

def contar(tablero,animal):
    n_fila = tablero.shape[0]
    n_columna = tablero.shape[1]
    contador = 0
    for i in range(1,n_fila-1):
        for j in range(1,n_columna-1):
            coordenada_actual = (i,j)
            if tablero[coordenada_actual] == animal:
                contador = contador + 1
    return contador

#%%
    
#Modifico evolucionar_tiempo para que tenga en cuenta la posible extincion de antilopes
    
def evolucionar_tiempo_ex(tablero,tiempo_limite):
    antilope = 'A'
    i = 0
    while i < tiempo_limite:
        evolucionar(tablero)
        contador = contar(tablero,antilope)
        if contador == 0:
            #print('Antilopes extintos en el ciclo',str(i)+'.')
            #print('')
            return tablero
        i = i + 1
        #print('Fin del ciclo',i)
        #print('')
    return tablero

#%%
    
#Probamos
'''
filas = 6 #4 casillas de alto
columnas = 8 #6 casillas de ancho

tablero = generar_tablero(filas,columnas)
print(tablero)
print('')

x = [2,3,4,4,2]
y = [2,3,3,5,5]

tipos = ['A','A','A','L','L']

ciclos = 10

for i in range(len(tipos)):
    tablero[(x[i],y[i])] = tipos[i]

print(tablero)
print('')
 
print(evolucionar_tiempo_ex(tablero,ciclos))
'''
#%%

#Distintas cantidades de leones y antilopes ubicados al azar
#Veamos

def mezclar_celdas(tablero):
    celdas = []
    n_filas = tablero.shape[0]
    n_columnas = tablero.shape[1]
    
    for i in range(1,n_filas-1):
        for j in range(1,n_columnas-1):
            celdas.append((i,j))
    #Y ahora mezclamos
    rn.shuffle(celdas)
    
    return celdas

#Generar tablero al azar

def generar_tablero_aleatorio(alto,ancho,n_antilopes,n_leones):
    suelo = ' '
    montaña = 'M'
    antilope = 'A'
    leon = 'L'
    
    tablero = np.repeat(suelo,(alto+2)*(ancho+2)).reshape(alto+2,ancho+2)
    celdas = mezclar_celdas(tablero)
    antilopes = []
    leones = []
    
    i = 0
    while i < n_antilopes:
        antilopes.append(antilope)
        i = i + 1
    j = 0
    while j < n_leones:
        leones.append(leon)
        j = j + 1
    
    for indice_fila in range(ancho+2):
        tablero[(0,indice_fila)] = montaña
        tablero[(alto+1,indice_fila)] = montaña

    for indice_columna in range(alto+2):
        tablero[(indice_columna,0)] = montaña
        tablero[(indice_columna,ancho+1)] = montaña
    
    k = 0
    while k < n_antilopes:
        tablero[celdas.pop(0)] = antilope
        k = k + 1
    l = 0
    while l < n_leones:
        tablero[celdas.pop(0)] = leon
        l = l + 1
    '''
    ESTO SE VA DE INDICE PARA NUMEROS GRANDES
    EL POP REDUCE EL LARGO DE LA LISTA
    Y EL INDICE SE PASA
    for k in range(0,len(antilopes)):
        tablero[(celdas.pop(k))] = antilope
    
    for l in range(0,len(leones)):
        tablero[(celdas.pop(l))] = leon
    '''
    time.sleep(0.1)
    print_tablero(tablero)
    return tablero

#tablero = generar_tablero_aleatorio(10,10,10,5)
#print(tablero)
#%%
    
#Quiero contar cuantos antilopes y leones hay
    
def cuantos_de_cada(tablero):
    n_fila = tablero.shape[0]
    n_columna = tablero.shape[1]
    antilope = 'A'
    leon = 'L'
    n_antilopes = 0
    n_leones = 0
    for i in range(1,n_fila-1):
        for j in range(1,n_columna-1):
            coordenada_actual = (i,j)
            if tablero[coordenada_actual] == antilope:
                n_antilopes = n_antilopes + 1
            elif tablero[coordenada_actual] == leon:
                n_leones = n_leones + 1
    resultado = [n_antilopes,n_leones]
    #print('Hay',resultado[0],'antilopes y',resultado[1],'leones.')
    return resultado

#cuantos_de_cada(tablero)
    
#%%

#Ahora queremos algo parecido a evolucionar en el tiempo pero que registre la cantidad
#de leones y antilopes que hay en cada ciclo y devuelva una lista con todos esos resultados
    
def registrar_evolucion(tablero,tiempo_limite):
    registro = []
    i = 0
    while i < tiempo_limite:
        contador = cuantos_de_cada(tablero)
        #print(contador)
        #print()
        registro.append(contador)
        evolucionar(tablero)
        if contador[0] == 0:
            contador.append(i)
            time.sleep(0.1)
            print_tablero(tablero)
            print('Antilopes extintos en el ciclo',str(i)+'.')
            return registro
        i = i + 1
        time.sleep(0.1)
        #print('Fin del ciclo',i)
        #print('')
    return registro

#%%

#Para un tablero de 20x20 quiero ver cuanto duran los antilopes
#Empiezo con 5 antilopes y 2 leones
#Aumento la cantidad de antilopes de a 1 y los leones siempre son un tercio de estos
#Registro el tiempo que tardan en extinguirse los antilopes
#Muestro el tablero inicial en el que mas aguantaron

alto = 20
ancho = 20
ciclos = 50

#Genero listas con las cantidades de antilopes y de leones

cant_animales = []

n = 6
while n <= (3/4)*alto*ancho:
    cant_animales.append((n,int(n/3)))
    n = n + 1

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

def evolucion_multiple(alto,ancho,cant_animales,ciclos):
    t_supervivencia = 0
    tableros = []
    for animales in cant_animales:
        tablero = generar_tablero_aleatorio(alto,ancho,animales[0],animales[1])
        tablero_inicial = tablero.copy()
        tableros.append(tablero_inicial)
        evolucion_especies = registrar_evolucion(tablero,ciclos)
        i = 0
        while i < len(evolucion_especies):
            #if (evolucion_especies[i])[0] == 0:
                #print(animales,(evolucion_especies[i])[2])
            if (evolucion_especies[i])[0] == 0 and t_supervivencia <= (evolucion_especies[i])[2]:
                t_supervivencia = (evolucion_especies[i])[2]
                prueba = encontrar_elemento(animales,cant_animales)
            i = i + 1
    #print(tableros[prueba[0]])
    #return [t_supervivencia,prueba[0],cant_animales[prueba[0]]]
    return tableros[prueba[0]]

'''
res = evolucion_multiple(alto,ancho,cant_animales,ciclos)
print(res)
'''
#%%
 

###SIMULACION EN VIVO Y EN DIRECTO###

alto = 10
ancho = 10
n_antilopes = 25
n_leones = 5

tablero = generar_tablero_aleatorio(alto,ancho,n_antilopes,n_leones)
res = registrar_evolucion(tablero,1000)
