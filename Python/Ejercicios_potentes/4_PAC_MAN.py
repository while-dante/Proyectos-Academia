###PACMAAAANNN###

#Para cada funcion que creemos vamos a crear un test que la pruebe
import numpy as np
import random as rn
import time
import os
import sys
import select
import termios
import contextlib
from IPython.display import clear_output

def mis_vecinos(coord_centro):
    arriba = (coord_centro[0]-1,coord_centro[1])
    derecha = (coord_centro[0],coord_centro[1]+1)
    abajo = (coord_centro[0]+1,coord_centro[1])
    izquierda = (coord_centro[0],coord_centro[1]-1)
    coordenadas_vecinas = [arriba,abajo,izquierda,derecha]
    return coordenadas_vecinas

def crear_tablero(filas,columnas):
    tablero = (np.repeat(0,(filas+2)*(columnas+2))).reshape(filas+2,columnas+2)
    n_filas = tablero.shape[0]
    n_columnas = tablero.shape[1]
    for fila in range(0,n_filas):
        tablero[(fila,0)] = 1
        tablero[(fila,n_columnas-1)] = 1
    for columna in range(0,n_columnas):
        tablero[(0,columna)] = 1
        tablero[(n_filas-1,columna)] = 1
    return tablero

def contar(tablero,numero):
    n_fila = tablero.shape[0]
    n_columna = tablero.shape[1]
    contador = 0
    for i in range(1,n_fila-1):
        for j in range(1,n_columna-1):
            coordenada_actual = (i,j)
            if tablero[coordenada_actual] == numero:
                contador = contador + 1
    return contador

def rellenar_tablero(tablero):
    n_filas = tablero.shape[0]
    n_columnas = tablero.shape[1]
    for columna in range(2,int((n_columnas-1)/2)):
        tablero[(2,columna)] = 1
    for columna in range(int((n_columnas-1)/2)+2,n_columnas-2):
        tablero[(2,columna)] = 1
    for columna in range(2,int((n_columnas-1)/2)):
        tablero[(n_filas-3,columna)] = 1
    for columna in range(int((n_columnas-1)/2)+2,n_columnas-2):
        tablero[(n_filas-3,columna)] = 1
    for columna in range(1,n_columnas-2):
        tablero[(4,columna)] = 1
    for columna in range(2,n_columnas-1):
        tablero[(n_filas-5,columna)] = 1
    for fila in range(5,6):
        tablero[(fila,3)] = 1
        tablero[(fila,8)] = 1
    for fila in range(7,n_filas-5):
        tablero[(fila,3)] = 1
        tablero[(fila,8)] = 1
    for fila in range(5,16):
        tablero[(fila,13)] = 1
    for fila in range(9,13):
        for columna in range(16,21):
            tablero[(fila,columna)] = 1

def buscar_adyacente(tablero,coord_centro,objetivo):
    adyacente = []
    vecinos = mis_vecinos(coord_centro)
    for coordenada in vecinos:
        if tablero[coordenada] == objetivo:
            adyacente.append(coordenada)
            return adyacente
    return adyacente

def buscar_adyacentes(tablero,coord_centro,objetivo):
    adyacentes = []
    vecinos = mis_vecinos(coord_centro)
    for coordenada in vecinos:
        if tablero[coordenada] == objetivo:
            adyacentes.append(coordenada)
    return adyacentes

def posiciones_iniciales(tablero):
    pacman = 6
    septo = 7
    octo = 8
    nona = 9
    tablero[(15,18)] = pacman
    tablero[(13,5)] = septo
    tablero[(14,5)] = octo
    tablero[(15,5)] = nona
    
def buscar_pacman(tablero):
    filas = tablero.shape[0]
    columnas = tablero.shape[1]
    pacman = 6
    for i in range(0,filas-1):
        for j in range(0,columnas-1):
            coordenada_actual = (i,j)
            if tablero[coordenada_actual] == pacman:
                return coordenada_actual

def buscar_fantasmas(tablero):
    septo = 7
    octo = 8
    nona = 9
    posiciones = []
    filas = tablero.shape[0]
    columnas = tablero.shape[1]
    while len(posiciones) < 3:
        for i in range(1,filas-2):
            for j in range(1,columnas-2):
                coordenada_actual = (i,j)
                if len(posiciones) == 0 and tablero[coordenada_actual] == septo:
                    posiciones.append(coordenada_actual)
                if len(posiciones) == 1 and tablero[coordenada_actual] == octo:
                    posiciones.append(coordenada_actual)
                if len(posiciones) == 2 and tablero[coordenada_actual] == nona:
                    posiciones.append(coordenada_actual)
    return posiciones

def mover_pacman(tablero,direccion):
    pacman = 6
    posicion_actual = buscar_pacman(tablero)
    if posicion_actual != None:
        vecinos = mis_vecinos(posicion_actual)
        if direccion == 'W' and tablero[vecinos[0]] != 1:
            if tablero[vecinos[0]] == 7 or tablero[vecinos[0]] == 8 or tablero[vecinos[0]] == 9:
                tablero[posicion_actual] = 0
            else:
                tablero[posicion_actual] = 0
                x = posicion_actual[0] - 1
                y = posicion_actual[1]
                tablero[(x,y)] = pacman
        elif direccion == 'S' and tablero[vecinos[1]] != 1:
            if tablero[vecinos[1]] == 7 or tablero[vecinos[1]] == 8 or tablero[vecinos[1]] == 9:
                tablero[posicion_actual] = 0
            else:
                tablero[posicion_actual] = 0
                x = posicion_actual[0] + 1
                y = posicion_actual[1]
                tablero[(x,y)] = pacman
        elif direccion == 'A' and tablero[vecinos[2]] != 1:
            if tablero[vecinos[2]] == 7 or tablero[vecinos[2]] == 8 or tablero[vecinos[2]] == 9:
                tablero[posicion_actual] = 0
            else:
                tablero[posicion_actual] = 0
                x = posicion_actual[0] 
                y = posicion_actual[1] - 1
                tablero[(x,y)] = pacman
        elif direccion == 'D' and tablero[vecinos[3]] != 1:
            if tablero[vecinos[3]] == 7 or tablero[vecinos[3]] == 8 or tablero[vecinos[3]] == 9:
                tablero[posicion_actual] = 0
            else:
                tablero[posicion_actual] = 0
                x = posicion_actual[0] 
                y = posicion_actual[1] + 1 
                tablero[(x,y)] = pacman
    else:
         graficar(tablero)
         print('GAME OVER')

def mover_septo(tablero):
    septo = 7
    coordenada_pacman = buscar_pacman(tablero)
    posicion_actual = buscar_fantasmas(tablero)[0]
    vecinos = mis_vecinos(posicion_actual)
    dist_x = posicion_actual[0]-coordenada_pacman[0]
    dist_y = posicion_actual[1]-coordenada_pacman[1] 
    if abs(dist_x) > abs(dist_y):
        if dist_x < 0 and (tablero[vecinos[1]] == 0 or tablero[vecinos[1]] == 6):
            tablero[posicion_actual] = 0
            x = posicion_actual[0] + 1
            y = posicion_actual[1]  
            tablero[(x,y)] = septo
        elif dist_x > 0 and (tablero[vecinos[0]] == 0 or tablero[vecinos[0]] == 6):
            tablero[posicion_actual] = 0
            x = posicion_actual[0] - 1
            y = posicion_actual[1]  
            tablero[(x,y)] = septo
    elif abs(dist_x) < abs(dist_y):
        if dist_y < 0 and (tablero[vecinos[3]] == 0 or tablero[vecinos[3]] == 6):
            tablero[posicion_actual] = 0
            x = posicion_actual[0]
            y = posicion_actual[1] + 1  
            tablero[(x,y)] = septo
        elif dist_y > 0 and (tablero[vecinos[2]] == 0 or tablero[vecinos[2]] == 6):
            tablero[posicion_actual] = 0
            x = posicion_actual[0] 
            y = posicion_actual[1] - 1
            tablero[(x,y)] = septo
    else:
        rn.shuffle(vecinos)
        for vecino in vecinos:
            if tablero[vecino] == 6 or tablero[vecino] == 0:
                tablero[posicion_actual] = 0
                tablero[vecino] = septo
                return

def mover_octo(tablero):
    octo = 8
    posicion_actual = buscar_fantasmas(tablero)[1]
    vecinos = mis_vecinos(posicion_actual)
    rn.shuffle(vecinos)
    for vecino in vecinos:
        if tablero[vecino] == 6:
            tablero[posicion_actual] = 0
            tablero[vecino] = octo
            return
        elif tablero[vecino] == 0:
            tablero[posicion_actual] = 0
            tablero[vecino] = octo
            return 

def distancia(coord1,coord2):
    x = (coord1[0]-coord2[0])**2
    y = (coord1[1]-coord2[1])**2
    dist = x + y
    return dist

def mover_nona(tablero):
    nona = 9
    posicion_actual = buscar_fantasmas(tablero)[2]
    vecinos = mis_vecinos(posicion_actual)
    coordenada_pacman = buscar_pacman(tablero)
    camino = posicion_actual
    dist = distancia(coordenada_pacman, posicion_actual)
    for vecino in vecinos:
        dist_aux = distancia(coordenada_pacman,vecino)
        if dist_aux <= dist and (tablero[vecino] == 0 or tablero[vecino] == 6):
            dist = dist_aux
            camino = vecino
    tablero[posicion_actual] = 0
    tablero[camino] = nona

def mover_fantasmas(tablero):
    if buscar_pacman(tablero) != None:
        mover_septo(tablero)      
        mover_octo(tablero)
        mover_nona(tablero)
    else:
        print('GAME OVER')

def graficar(tablero):
    for i in range(tablero.shape[0]):
        for j in range(tablero.shape[1]):
            if tablero[(i,j)] == 0:
                print(chr(0x00002B1C),end='')
            if tablero[(i,j)]==1:
                print(chr(0x00002B1B),end='')
            if tablero[(i,j)]==6:
                print(chr(0x0001F602),end='')
            if tablero[(i,j)]==7 :
                print(chr(0x0001F608),end='')
            if tablero[(i,j)]==8 :
                print(chr(0x0001F47B),end='')
            if tablero[(i,j)]==9 :
                print(chr(0x0001F480),end='')
        print()
    print()

'''
def jugar():
    tablero = crear_tablero(20, 20)
    rellenar_tablero(tablero)
    posiciones_iniciales(tablero)
    wasd = ['S']
    i = 0
    while i < len(wasd):
        time.sleep(0.3)
        graficar(tablero)
        mover_pacman(tablero, wasd[i])
        time.sleep(0.3)
        graficar(tablero)
        mover_fantasmas(tablero)
        time.sleep(0.3)
        graficar(tablero)


def prueba():
    tablero = crear_tablero(20, 20)
    rellenar_tablero(tablero)
    posiciones_iniciales(tablero)
    while True:
        mover_fantasmas(tablero)
        time.sleep(0.3)
        graficar(tablero)
'''

#%%

tablero = crear_tablero(20, 20)
rellenar_tablero(tablero)
posiciones_iniciales(tablero)

@contextlib.contextmanager
def decanonize(fd):
    old_settings = termios.tcgetattr(fd)
    new_settings = old_settings[:]
    new_settings[3] &= ~termios.ICANON
    termios.tcsetattr(fd, termios.TCSAFLUSH, new_settings)
    yield
    termios.tcsetattr(fd, termios.TCSAFLUSH, old_settings)

with decanonize(sys.stdin.fileno()):
    try:
        while True:
            i,o,e = select.select([sys.stdin],[],[],1)
            if i and i[0] == sys.stdin:
                graficar(tablero)
                tecla = sys.stdin.read(1)
                ###########
                # la variable tecla dice que tecla presionaron
                # completar con la logica de mover el pacman y los fantasmas
                tecla = tecla.upper()

                mover_pacman(tablero, tecla)
                mover_fantasmas(tablero)
                ###########
                clear_output()
                os.system('clear')
                graficar(tablero)
                ###########
                # Aca se imprime el tablero
                ###########
                
    except KeyboardInterrupt:
        pass

#%%
    
def test_mis_vecinos():
    c = (1,1)
    vecinos = mis_vecinos(c)
    coordenadas_esperadas = [(0,1),(1,2),(2,1),(1,0)]
    assert len(vecinos) == 4
    for coordenada in coordenadas_esperadas:
        assert coordenada in vecinos

test_mis_vecinos()

def test_crear_tablero():
    filas = 15
    columnas = 10
    tablero = crear_tablero(filas, columnas)
    assert tablero.shape[0] == filas + 2
    assert tablero.shape[1] == columnas + 2
    for fila in range(0,filas+2):
        assert tablero[(fila,0)] == 1
        assert tablero[(fila,columnas+1)] == 1
    for columna in range(0,columnas+2):
        assert tablero[(0,columna)] == 1
        assert tablero[(filas+1,columna)] == 1
    for fila in range(1,filas+1):
        for columna in range(1,columnas+1):
            c = (fila,columna)
            assert tablero[(c)] == 0

test_crear_tablero()

def test_contar():
    tablero = np.repeat(1,16).reshape(4,4)
    tablero[(1,1)] = 0
    valor_esperado = 3
    assert contar(tablero, 1) == valor_esperado
  
test_contar()

def test_rellenar_tablero():
    tablero = crear_tablero(20,20)
    n_filas = tablero.shape[0]
    n_columnas = tablero.shape[1]
    cant_0 = contar(tablero, 0)
    cant_1 = contar(tablero, 1)
    rellenar_tablero(tablero)
    for columna in range(2,int((n_columnas-1)/2)):
        assert tablero[(2,columna)] == 1
    for columna in range(int((n_columnas-1)/2)+2,n_columnas-2):
        assert tablero[(2,columna)] == 1
    for columna in range(2,int((n_columnas-1)/2)):
        assert tablero[(n_filas-3,columna)] == 1
    for columna in range(int((n_columnas-1)/2)+2,n_columnas-2):
        assert tablero[(n_filas-3,columna)] == 1
    for columna in range(1,n_columnas-2):
        assert tablero[(4,columna)] == 1
    for columna in range(2,n_columnas-1):
        assert tablero[(n_filas-5,columna)] == 1
    for fila in range(5,6):
        assert tablero[(fila,3)] == 1
        assert tablero[(fila,8)] == 1
    for fila in range(7,n_filas-5):
        assert tablero[(fila,3)] == 1
        assert tablero[(fila,8)] == 1
    for fila in range(5,16):
        assert tablero[(fila,13)] == 1
    for fila in range(9,13):
        for columna in range(16,21):
            assert tablero[(fila,columna)] == 1
    assert cant_0 == (n_filas-2)*(n_columnas-2) - cant_1

test_rellenar_tablero()

def test_buscar_adyacente():
    prueba0 = np.repeat(0,9).reshape(3,3)
    prueba0[(0,1)] = 1 
    coordenada_esperada0 = [(0,1)]
    assert buscar_adyacente(prueba0, (1,1), 1) == coordenada_esperada0
    prueba1 = np.repeat(0,9).reshape(3,3)
    coordenada_esperada1 = []
    assert buscar_adyacente(prueba1, (1,1), 1) == coordenada_esperada1

test_buscar_adyacente()

def test_posiciones_iniciales():
    tablero = crear_tablero(20, 20)
    rellenar_tablero(tablero)
    posiciones_iniciales(tablero)
    pacman = 6
    septo = 7
    octo = 8
    nona = 9
    assert tablero[(15,18)] == pacman
    assert tablero[(13,5)] == septo
    assert tablero[(14,5)] == octo
    assert tablero[(15,5)] == nona

test_posiciones_iniciales()

def test_buscar_pacman():
    tablero = crear_tablero(20, 20)
    rellenar_tablero(tablero)
    posiciones_iniciales(tablero)
    posicion_esperada = (15,18)
    assert buscar_pacman(tablero) == posicion_esperada

test_buscar_pacman()
    
def test_buscar_fantasmas():
    tablero = crear_tablero(20, 20)
    rellenar_tablero(tablero)
    posiciones_iniciales(tablero)
    coordenadas = buscar_fantasmas(tablero)
    assert coordenadas == [(13,5),(14,5),(15,5)]

test_buscar_fantasmas()
   
def test_mover_pacman():
    tablero = crear_tablero(20, 20)
    rellenar_tablero(tablero)
    posiciones_iniciales(tablero)
    mover_pacman(tablero, 'W')
    mover_pacman(tablero, 'W')    
    mover_pacman(tablero, 'W')
    pos_esperada = (13,18)
    pos = buscar_pacman(tablero)
    assert pos == pos_esperada

test_mover_pacman() 

