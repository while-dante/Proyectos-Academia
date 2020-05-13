### PERSONAS EN UN AVION###

import random as rn

# 100 personas abordan un avion con 100 asientos numerados
# El primero en la fila perdio su voleto y se sienta al azar
# Los demas se sientan en sus lugares asignados pero si ya estaba ocupado se sientan al azar
# Quiero saber la probabilidad de que el ultimo en la fila se siente en su lugar

#Creo el avion

def crearAvion(nAsientos):
    avion = []
    i = 0
    
    while i < nAsientos:
        avion.append(-1)
        i = i + 1
        
    return avion

#Hago la fila de pasajeros, llegan a la cola en orden aleatorio
#Cada uno tiene un numero asignado
    
def crearFila(nAsientos):
    fila = []
    i = 0
    
    while i < nAsientos:
        fila.append(i)
        i = i + 1
        
    rn.shuffle(fila)
    return fila

#Guardo el ultimo de la fila

def verUltimo(fila):
    ultimo = fila[len(fila) - 1]
    return ultimo

#Me fijo en los asientos libres

def asientosLibres(avion):
    libres = []
    i = 0
    
    while i < len(avion):
        if avion[i] == -1:
            libres.append(i)
        i = i + 1
    return libres

#Hago que los pasajeros se sienten

def sentar(avion,pasajeros):
    
    avion[rn.randint(0,len(avion)-1)] = pasajeros[0] #El primero se sienta al azar
    pasajeros.pop(0)
    
    while len(pasajeros) > 0:
        libres = asientosLibres(avion)
        
        if avion[pasajeros[0]] == -1:
            avion[pasajeros[0]] = pasajeros[0]
            pasajeros.pop(0)
        else:
            avion[libres[rn.randint(0,len(libres)-1)]] = pasajeros.pop(0)

#Me fijo si el ultimo de la fila esta en su lugar

def chequearUltimo(avion,fila,ultimo):
    if avion[ultimo] == ultimo:
        return True
    else:
        return False

#Hago todo el proceso junto
        
def abordaje(nAsientos):
    
    avion = crearAvion(nAsientos)
    fila = crearFila(nAsientos)
    ultimo = verUltimo(fila)
    
    sentar(avion,fila)
    return chequearUltimo(avion, fila, ultimo)

#Repito el proceso y calculo la probabilidad

def probabilidadUltimoBienSentado(nAsientos,nRepeticiones):
    i = 0
    resultados = []
    
    while i < nRepeticiones:
        resultados.append(abordaje(nAsientos))
        i = i + 1
    
    verdaderos = 0
    
    for resultado in resultados:
        if resultado == True:
            verdaderos = verdaderos + 1
    
    proba = verdaderos/nRepeticiones
    
    return proba

nAsientos = 100
nRepeticiones = 10000

proba = probabilidadUltimoBienSentado(nAsientos, nRepeticiones)

print("Probabilidad de que el ultimo en la fila se siente en su asiento:",proba)

#%%

def testAvion():
    avion = crearAvion(100)
    assert len(avion) == 100
    
    i = 0
    while i < 100:
        assert avion[i] == -1
        i = i + 1

testAvion()

def testFila():
    fila = crearFila(100)
    assert len(fila) == 100
    
    i = 0
    while i < 100:
        assert i in fila
        i = i + 1

testFila()

def testVerUltimo():
    fila = crearFila(100)
    ultimo = verUltimo(fila)
    assert ultimo == fila[len(fila)-1]

testVerUltimo()

def testAsientosLibres():
    avion = [-1,1,-11,-1]
    libres = asientosLibres(avion)
    assert libres == [0,3]

testAsientosLibres()

def testSentar():
    avion = [-1,-1,-1,-1,-1]
    pasajeros = [0,1,2,3,4]
    sentar(avion,pasajeros)
    assert len(pasajeros) == 0
    for pasajero in pasajeros:
        assert pasajero in avion

testSentar()

def testChequearUltimo():
    fila = [2,5,4,0,3,1]
    ultimo = verUltimo(fila)
    
    avionT = [0,1,3,4,2,5]
    avionF = [0,2,3,1,5,4]
    
    assert chequearUltimo(avionT, fila,ultimo) == True
    assert chequearUltimo(avionF, fila,ultimo) == False

testChequearUltimo()

    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
