#NanoJack

from random import shuffle

sin_cartas = 2

n = 1

#Genera un mazo de n mazos de poker

def generar_mazos(n):
    cartas = []
    i = 0
    while i < n:
        j = 1
        while j < 14:
            k = 1
            while k < 5:
                cartas.append(j)
                k = k + 1
            j = j + 1
        i = i + 1
    shuffle(cartas)
    return cartas

#mazo = generar_mazos(n)
#print(generar_mazos(n))

#%%

#Jugar con un mazo m


def jugar_solo(m):
    puntaje = 0
    i = 0
    while i <= len(m):
        while puntaje < 21:
            if len(m) <= 0:
                print('Fin de la partida')
                return 0 
                #return 2
            else:
                puntaje = puntaje + m[0]
                m.pop(0)
                if puntaje == 21:
                    print('Wow... ganaste. ¿Estás satisfecho/a?')
                    return puntaje
                elif puntaje > 21:
                    print('¡Jajaaa! PERDISTE')
                    return puntaje
        i = i + 1

#puntaje = jugar_solo(mazo)
#print(puntaje)

def jugar(m):
    puntaje = 0
    i = 0
    while i <= len(m):
        while puntaje < 21:
            if len(m) <= 0:
                return sin_cartas
            else:
                puntaje = puntaje + m[0]
                m.pop(0)
                if puntaje == 21:
                    return puntaje
                elif puntaje > 21:
                    return puntaje
        i = i + 1

#%%

#Jugar j jugadores con mazo m

j = 2

def jugar_varios(m,j):
    resultados = []
    i = 1
    while i <= j:
        resultados.append(jugar(m))
        i = i + 1
    return resultados

#puntajes = jugar_varios(mazo,j)
#print(puntajes)

#%%
#Ver quien gano

def ver_quien_gano(resultados):
    i = 0
    condicion = []
    while i < len(resultados):
        if resultados[i] == 21:
            condicion.append(1)
        elif resultados[i] == sin_cartas:
            condicion.append(resultados[i])
        else:
            condicion.append(0)
        i = i + 1
    return condicion

#resultados = ver_quien_gano(puntajes)
#print(resultados)

#%%
'''
def experimentar(rep, jug, mazo):
    res = []
    i = 1
    k = 0
    contador = 0
    while i <= rep:
        puntajes = jugar_varios(mazo,jug)
        resultados = ver_quien_gano(puntajes)
        while k < len(resultados):
            if resultados[k] == 1:
                contador = contador + 1
                res.append(contador)
            else:
                res.append(contador)
            k = k + 1
        i = i + 1
    return res
'''

rep = 1
jug = 1

def experimentar2(rep,jug,mazo):
    i = 1
    counter = []
    while i <= rep:
        j = 0
        puntajes = jugar_varios(mazo,jug)
        resultados = ver_quien_gano(puntajes)
        #print(i,puntajes)
        print(i,resultados)
        if i == 1:
            counter = resultados
        else:
            while j < len(resultados):
                if counter[j] == sin_cartas:
                    return [sin_cartas]
                else:
                    counter[j] = counter[j] + resultados[j]
                    j = j + 1
        i = i + 1
    return counter

#prueba = experimentar2(rep,jug,mazo)
#print(prueba)

#%%

def jugar_nano_jack(n,j,r):
    mazo = generar_mazos(n)
    puntos = experimentar2(r,j,mazo)
    mensaje = []
    i = 0
    while i < j:
        if puntos[i] == sin_cartas:
            return 'Nos quedamos sin cartas'
        else:
            mensaje.append(puntos[i])
            mensaje[i] = str(mensaje[i])
            mensaje[i] = 'Jugador'+str(i+1)+':'+' '+mensaje[i]
        i = i + 1
    return mensaje

#%%    
    
###JUGAR NANOJACK###

'''
n = cantidad de mazos de poker mezclados en un solo mazo
j = cantidad de jugadores
r = cantidad de veces que juegan
'''

cant_mazos = 20
jugadores = 7
repeticiones = 5


juego = jugar_nano_jack(cant_mazos,jugadores,repeticiones)
print(juego)

#%%


