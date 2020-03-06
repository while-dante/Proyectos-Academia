
a = 'Ana'

def devolver_longitud_de_un_nombre(nombre):
    return len(nombre)

#%%

def devolver_primer_elemento_de_la_lista(lista):
    return lista[0]

#%%

def devolver_segundo_elemento_del_nombre(nombre):
    return nombre[1]

#%%
    
def devolver_ultimo_elemento_del_nombre(nombre):
    return nombre[-1]

#%%

def devolver_la_letra_en_posicion_del_nombre(nombre,posicion):
    if posicion >= len(nombre):
        print('No se puede')
    else:
        return nombre[posicion]

#%%

lista = ['a','b','c','d']
xd = 'xd'

def reemplazar_ultimo_elemento_de_una_lista(lista,elemento):
    lista[-1] = elemento
    return lista

print(lista)
print(reemplazar_ultimo_elemento_de_una_lista(lista,xd))
#%%

def agregar_25_al_final_de_la_lista():
    lista = ['Casa',5,'A']
    elemento = 25
    lista.append(elemento)
    return (lista)

#%%

prueba = [2,5,6,7]    

def lista_doble_del_primero(lista):
    lista[0] = 2*lista[0]
    return lista

print(prueba)
print(lista_doble_del_primero(prueba))

#%%

prueba = [2,5,6,7]

def lista_triple_del_ultimo(lista):
    lista[-1] = 3*lista[-1]
    return lista

print(prueba)
print(lista_triple_del_ultimo(prueba))

#%%

prueba = [2,5,6,7]

def doble_triple(lista):
    lista_doble_del_primero(lista)
    lista_triple_del_ultimo(lista)
    return lista

print(prueba)
print(doble_triple(prueba))

#%%

prueba = [2,5,6,7]
agregado = 8

def agrega_esto(lista,esto):
    lista.append(esto)
    return lista

print(prueba)
print(agrega_esto(prueba,agregado))

    
    
    
