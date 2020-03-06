def decir_si_es_mas_grande_que_5():
    numero = 6
    return numero > 5

print(decir_si_es_mas_grande_que_5())

#%%

def decir_si_la_longitud_es_mayor_a_5():
    unNombre = 'Camel Black'
    return len(unNombre) > 5

print(decir_si_la_longitud_es_mayor_a_5())

#%%

numeros = [-2,0,5,8,127840]
 
def decir_si_es_mas_grande_que(unNumero):
    if unNumero > 5:
        return 'Es mas grande'
    else:
        return 'No es mas grande'

resultados = []

for i in numeros:
    resultados.append(decir_si_es_mas_grande_que(i))

print(numeros)
print(resultados)

#%%

def decir_si_es_igual_a(unNumero):
    numero = 10
    return unNumero == numero

numeros = [9,10,11]
resultado = []
i = 0

while i <len(numeros):
    resultado.append(decir_si_es_igual_a(numeros[i]))
    i = i + 1

print(numeros)
print(resultado)

#%%

def decir_si_la_longitud_es_igual_a(nombre,numero):
    return len(nombre) == numero

prueba = decir_si_la_longitud_es_igual_a('cinco',5)
print(prueba)

#%%

#Funcion que dice si unnumero es par

def es_par(n):
    resto = n%2
    return resto == 0

#%%
    
def devolver_valor_mas_grande(a,b):
    if a > b:
        resultado = a
    else:
        resultado = b
    return resultado

prueba = devolver_valor_mas_grande(1,0)
print(prueba)

#%%

def devolver_el_doble_si_es_par(n):
    if es_par(n):
        resultado = 2*n
    else:
        resultado = n
    return resultado

numeros = [3,6,8,1,2]
resultados = []

i = 0

while i < len(numeros):
    resultados.append(devolver_el_doble_si_es_par(numeros[i]))
    i = i + 1

print(resultados)

#%%

def devolver_segun_condiciones_locas(n):
    if n == 2:
        resultado = n + 1
    elif n <= 10:
        resultado = 2*n
    elif n > 20 and n < 34:
        resultado = n + 5
    else:
        resultado = 0
    return resultado

numeros = [2,8,25,13]
resultados = []

i = 0

while i < len(numeros):
    resultados.append(devolver_segun_condiciones_locas(numeros[i]))
    i = i + 1

print(numeros)
print(resultados)

#%%

def _1020(n):
    if 10 < n and n < 20:
        resultado = 2*n
    else:
        resultado = n
    return resultado

resultados = []

i = 0

while i < len(numeros):
    resultados.append(_1020(numeros[i]))
    i = i + 1

print(numeros)
print(resultados)

#%%
    
def raios(n):
    if n < 5 or n > 20:
        print(n,'Rayos y Centellas')

resultados = []

i = 0

while i < len(numeros):
    resultados.append(raios(numeros[i]))
    i = i + 1

print(numeros)

#%%

def en_rango(n):
    if n > 5 and n < 10:
        print('Esta es el rango deseado')
    else:
        print('Fuera de Rango')

resultados = []

i = 0

while i < len(numeros):
    resultados.append(en_rango(numeros[i]))
    i = i + 1

print(numeros)

#%%

def estimador(n):
    if n < 5:
        print('Menor a 5')
    elif n > 10 and n < 20:
        print('Entre 10 y 20')
    else:
        print('Numero muy grande')

resultados = []

i = 0

while i < len(numeros):
    resultados.append(estimador(numeros[i]))
    i = i + 1

print(numeros)