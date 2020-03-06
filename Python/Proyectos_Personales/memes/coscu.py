#Coscuficador de palabras

def coscu(palabra):
    lista = list(palabra)
    if len(lista) == 0:
        print('¿Qué te hacés el picantovich, rancio?')
    elif lista[0] == 'n' or lista[0] == 'N':
        print('Ndeaahhh')
    else:
        if lista[-1] == 'a':
            lista[-1] = 'arda'
        elif lista[-1] == 'e' or lista[-1] == 'i' or lista[-1] == 'o' or lista[-1] == 'u':
            lista[-1] = 'oide'
        else:
            lista.append('oide')
        palabrarda = ''
        for i in lista:
            palabrarda = palabrarda + i
        print(palabrarda)
