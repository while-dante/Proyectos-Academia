import random as rn
import matplotlib.pyplot as plt
###ENCONTRAR NUMEROS EN CAJAS
##JUEGAN P PERSONAS Y A CADA UNA SE LE ASIGNA UN NUMERO DISTINTO DEL 1 A P
##LOS NUMERO SE GUARDAN EN P CAJAS NUMERADAS
##CADA PERSONA TIENE QUE ENCONTRAR SU NUMERO EN P/2 INTENTOS O MENOS PARA QUE TODOS GANEN

#LAS CAJAS SON POSICIONES EN UNA LISTA

#%%

#COMPARAMOS DOS METODOS PARA BUSCAR TU NUMERO

###ABRIR CAJAS AL AZAR (SIN REPETIR):
        
#DEFINIMOS UN ORDEN DE BUSQUEDA ALEATORIO

def esta_en(elemento, lista):
    i = 0
    while i < len(lista):
        if lista[i] == elemento:
            return True
        i = i + 1
    return False

def orden_aleatorio(entero_inferior,entero_superior):
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

###ABRIR CAJA CON EL ULTIMO NUMERO QUE ENCONTRASTE

def orden_cadena(elemento,lista):
    orden = [elemento]
    i = 0
    while i < len(lista):
        orden.append(lista[elemento])
        elemento = lista[elemento]
        i = i + 1
    return orden

#%%

#PARA BUSCAR EN LA LISTA USAMOS encontrar_elemento PERO LA MODIFICAMOS UN POCO

def buscar_elemento(elemento,lista,orden,oportunidades):
    intento = 0
    i = 0
    while intento < oportunidades:
        if lista[orden[i]] == elemento:
            return True
        i = i + 1
        intento = intento + 1
    return False

#%%
#BUSQUEDA, AHORA HACEMOS QUE TODOS BUSQUEN SU NUMERO Y REGISTRAMOS SI LO LOGRAN O NO

def busqueda(cant_personas,oportunidades,metodo):
    res = []
    personas = orden_aleatorio(0,cant_personas-1)
    cajas = orden_aleatorio(0,cant_personas-1)
    i = 0
    if metodo == 'aleatorio':
        while i < cant_personas:
            orden = orden_aleatorio(0,cant_personas-1)
            res.append(buscar_elemento(personas[i],cajas,orden,oportunidades))
            i = i + 1
    elif metodo == 'cadena':
        while i < cant_personas:
            orden = orden_cadena(personas[i],cajas)
            res.append(buscar_elemento(personas[i],cajas,orden,oportunidades))
            i = i + 1
    else:
        return 'Ingrese un metodo valido: <aleatorio> o <cadena>'
    return res

#HACEMOS MUCHAS PRUEBAS

def pruebas(cant_personas,oportunidades,metodo,repeticiones):
    exitos = 0
    i = 0
    while i < repeticiones:
        if not esta_en(False,busqueda(cant_personas,oportunidades,metodo)):
            exitos = exitos + 1
        i = i + 1
    proba = exitos/repeticiones
    return proba

#%%
            
personas = 100
oportunidades = []

i = 0
while i <= personas:
    oportunidades.append(i)
    i = i + 1

#%%
    

A = 'aleatorio'
C = 'cadena'

repeticiones = 100

proba_aleatorio = []
proba_cadena = []


i = 0
while i <= personas:
    proba_aleatorio.append(pruebas(personas,oportunidades[i],A,repeticiones))
    proba_cadena.append(pruebas(personas,oportunidades[i],C,repeticiones))
    i = i + 1


#%%
    
plt.figure()
plt.plot(oportunidades,proba_aleatorio,'r-',label='Metodo aleatorio')
plt.plot(oportunidades,proba_cadena,'b-',label='Metodo cadena')
plt.grid()
plt.legend()
plt.xlabel('Oportunidades por persona')
plt.ylabel('Probabilidad de exito')





