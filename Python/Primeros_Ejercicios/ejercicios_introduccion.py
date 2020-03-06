nombre = 'Marianito'
apellido = 'Cachirulo'

print('Nombre completo: ', apellido, ',', nombre)
print('Nombre completo: ', apellido + ',' + nombre)
print('Nombre completo:', apellido + ',', nombre)

#%%
#nombre[8] = 'a'
milista = list(nombre)
milista[8] = 'a'
print(nombre)
print(milista)

#%%
#Funcion que compare dos str y devuelva la mas larga

def mas_larga(n1,n2):
    if len(n1) > len(n2):
        return n1
    elif len(n2) > len(n1):
        return n2
    else:
        return 'son iguales'

nombre1 = 'Anuncias'
nombre2 = 'Lucho'
nombre3 = 'Gabinete'

print(mas_larga(nombre1,nombre3))
#print(mas_larga(nombre1,nombre2))

#%%
#Funcion que cuenta las letras 'e' de una palabra

def cont_e(palabra):
    i = 0
    contador = 0
    while i < len(palabra):
        if palabra[i]=='e':
            contador = contador + 1
        elif palabra[i]=='E':
            contador = contador + 1
        i = i + 1
    return contador

palabras = ['amigo','entender','pEligro']

i = 0
while i < len(palabras):
    print(palabras[i])
    print(cont_e(palabras[i]))
    i = i + 1

###AYUDA DE MIS AMIGOS LOS COMPUS
    
'''    
def count_u(word):
    counter = 0
    for letter in word:
        if letter == 'u' or letter == 'U':
            counter += 1
    return counter

u1 = count_u('argentina')
u2 = count_u('Uruguay')
print(u1, u2)
'''
#%%

#Funcion que cambia vocales por '-'

def delete_vocal(palabra):
    vocales = ['a','e','i','o','u','A','E','I','O','U']
    lista = list(palabra)
    i = 0
    j = 0
    while i < len(lista):
        while j < len(vocales):
            if lista[i]==vocales[j]:
                lista[i]='-'
            j = j + 1
        j = 0
        i = i + 1
    return lista

def construir_palabra(lista):
    palabra = ''
    i = 0
    while i < len(lista):
        palabra = palabra + lista[i]
        i = i + 1
    return palabra

def redacted(palabra):
    lista = delete_vocal(palabra)
    redac = construir_palabra(lista)
    return redac

palabra = 'Eucalipto'
redactada = redacted(palabra)

print('Palabra:',palabra)
print('Redactada:',redactada)

#%%

#Funcion que intercala palabras letra por letra

def fusion(p1,p2):
    lista1 = list(p1)
    lista2 = list(p2)
    i = 0
    j = 0
    fusion = []
    if len(lista1) > len(lista2):
        while i < len(lista2):
            fusion.append(lista1[i])
            fusion.append(lista2[i])
            i = i + 1
        while len(lista2) + j < len(lista1):
            fusion.append(lista1[len(lista2) + j])
            j = j + 1
    else:
        while i < len(lista1):
            fusion.append(lista2[i])
            fusion.append(lista1[i])
            i = i + 1
        while len(lista1) + j < len(lista2):
            fusion.append(lista2[len(lista1) + j])
            j = j + 1
    print(construir_palabra(fusion))

n1 = 'A cuatro dias del traspaso'
n2 = 'Fernandez anuncia su gabinete'

print('Palabras:',n1,'y',n2)
print('Fusion:')
fusion(n1,n2)

#%%

#Queria probar una cosa con los condicionales

def es_string(s):
    if type(s) == str:
        print('es string')
    else:
        print('no es string')


        

