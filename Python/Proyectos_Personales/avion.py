### PERSONAS EN UN AVION###

import random as rn

# 100 personas abordan un avion con 100 asientos numerados
# El primero en la fila perdio su voleto y se sienta al azar
# Los demas se sientan en sus lugares asignados pero si ya estaba ocupado se sientan al azar
# Quiero saber la probabilidad de que el ultimo en la fila se siente en su lugar

#Creo el avion

def crear_avion(n_asientos):
    avion = []
    i = 0
    
    while i < n_asientos:
        avion.append(-1)
        i = i + 1
        
    return avion

#Hago la fila de pasajeros, llegan a la cola en orden aleatorio
#Cada uno tiene un numero asignado
    
def crear_fila(n_asientos):
    fila = []
    i = 0
    
    while i < n_asientos:
        fila.append(i)
        i = i + 1
        
    rn.shuffle(fila)
    return fila

#Guardo el ultimo de la fila

def ver_ultimo(fila):
    ultimo = fila[len(fila) - 1]
    return ultimo

#Me fijo en los asientos libres

def asientos_libres(avion):
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
        libres = asientos_libres(avion)
        
        if avion[pasajeros[0]] == -1:
            avion[pasajeros[0]] = pasajeros[0]
            pasajeros.pop(0)
        else:
            avion[libres[rn.randint(0,len(libres)-1)]] = pasajeros.pop(0)

#Me fijo si el ultimo de la fila esta en su lugar

def chequear_ultimo(avion,fila,ultimo):
    if avion[ultimo] == ultimo:
        return True
    else:
        return False

#Hago todo el proceso junto
        
def abordaje(n_asientos):
    
    avion = crear_avion(n_asientos)
    fila = crear_fila(n_asientos)
    ultimo = ver_ultimo(fila)
    
    sentar(avion,fila)
    return chequear_ultimo(avion, fila, ultimo)

#Repito el proceso y calculo la probabilidad

def probabilidad_ultimo_bien_sentado(n_asientos,n_repeticiones):
    i = 0
    resultados = []
    
    while i < n_repeticiones:
        resultados.append(abordaje(n_asientos))
        i = i + 1
    
    verdaderos = 0
    
    for resultado in resultados:
        if resultado == True:
            verdaderos = verdaderos + 1
    
    proba = verdaderos/n_repeticiones
    
    return proba

n_asientos = 100
n_repeticiones = 10000

proba = probabilidad_ultimo_bien_sentado(n_asientos, n_repeticiones)

print("Probabilidad de que el ultimo en la fila se siente en su asiento:",proba)

#%%

def test_avion():
    avion = crear_avion(100)
    assert len(avion) == 100
    
    i = 0
    while i < 100:
        assert avion[i] == -1
        i = i + 1

test_avion()

def test_fila():
    fila = crear_fila(100)
    assert len(fila) == 100
    
    i = 0
    while i < 100:
        assert i in fila
        i = i + 1

test_fila()

def test_ver_ultimo():
    fila = crear_fila(100)
    ultimo = ver_ultimo(fila)
    assert ultimo == fila[len(fila)-1]

test_ver_ultimo()

def test_asientos_libres():
    avion = [-1,1,-11,-1]
    libres = asientos_libres(avion)
    assert libres == [0,3]

test_asientos_libres()

def test_sentar():
    avion = [-1,-1,-1,-1,-1]
    pasajeros = [0,1,2,3,4]
    sentar(avion,pasajeros)
    assert len(pasajeros) == 0
    for pasajero in pasajeros:
        assert pasajero in avion

test_sentar()

def test_chequear_ultimo():
    fila = [2,5,4,0,3,1]
    ultimo = ver_ultimo(fila)
    
    avionT = [0,1,3,4,2,5]
    avionF = [0,2,3,1,5,4]
    
    assert chequear_ultimo(avionT, fila,ultimo) == True
    assert chequear_ultimo(avionF, fila,ultimo) == False

test_chequear_ultimo()

    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
