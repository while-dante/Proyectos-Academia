"""BubbleSorting Algorithm"""

import numpy as np
import matplotlib.pyplot as  plt
import random as rn
import time as tm

def bubbleSortAscendingOrder(group):
    isSorted = False
    length = len(group)
    indexes = range(0,length-1)
    swaps = 0
    comparisons = 0
    
    while not isSorted:
        isSorted = True
        
        for i in indexes:
            temp = group[i]
            comparisons = comparisons +1
            
            if temp > group[i+1]:
                group[i] = group[i+1]
                group[i+1] = temp
                swaps = swaps +1
                isSorted = False
        
    return [group,comparisons,swaps]

def cuadratic(x):
    return x**2

size = list(range(1,1002,50))

rawResultsSwaps = []
resultsSwaps = []
rawResultsComps = []
resultsComps = []

model = []
raw = 0
"""startTime = tm.time()"""

for quant in size:
    model.append(cuadratic(quant))
    group = list(range(quant))
    
    rawResultsSwaps.append([])
    rawResultsComps.append([])
    repeats = 0
    while repeats < 50:
        rn.shuffle(group)
        info = bubbleSortAscendingOrder(group)
        
        comps = info[1]
        swaps = info[2]
        rawResultsComps[raw].append(comps)
        rawResultsSwaps[raw].append(swaps)
        repeats = repeats +1
        
    resultsSwaps.append(np.average(rawResultsSwaps[raw]))
    resultsComps.append(np.average(rawResultsComps[raw]))
    raw = raw +1

"""elapsedTime = tm.time() - startTime"""
"""print(tm.strftime("%H:%M:%S", tm.gmtime(elapsedTime)))"""

plt.figure()
plt.grid()
plt.plot(size,model,'b--',linewidth=2,label='Model of complexity')
plt.plot(size,resultsSwaps,'*g',markersize=4,label='Number of swaps')
plt.plot(size,resultsComps,'or',markersize=4,label='Number of comparisons')
plt.legend()
plt.xlim(0,1100)
plt.xlabel("n (number of distinct elements)")
    
    