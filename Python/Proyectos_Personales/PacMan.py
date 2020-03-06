#PAC-MAN

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

def rellenar_tablero(tablero):
    n_filas = tablero.shape[0]
    n_columnas = tablero.shape[1]
    tablero[(1,1)] = 1
    tablero[(1,20)] = 1

    for i in range(4,8):
        tablero[(2,i)]
    for i in range(14,18):
        tablero[(2,i)]

    tablero[(3,2)] = 1
    tablero[(3,19)] = 1

    for i in range(0,n_filas):
        tablero[(i,9)] = 1
        tablero[(i,12)] = 1

    tablero[(2,9)] = 0
    tablero[(6,9)] = 0
    tablero[(14,9)] = 0
    tablero[(18,9)] = 0
    tablero[(2,12)] = 0
    tablero[(6,12)] = 0
    tablero[(14,12)] = 0
    tablero[(18,12)] = 0
