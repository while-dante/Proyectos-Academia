import numpy as np
from matplotlib import pyplot as plt
import random as rn

class QuickSort:
    
    group = []
    first = 0
    last = 0
    comparisons = 0
    swaps = 0

    def __init__(self,group):
        self.group = group
        self.first = self.group.index(group[0])
        self.last = self.group.index(group[len(group)-1])
    
    def swap(self,i,j):
        temp = self.group[i]
        self.group[i] = self.group[j]
        self.group[j] = temp
        self.swaps += 1
        return True
    
    def partition(self,first,last):
        i = first-1
        pivot = self.group[last]

        for j in range(first,last):
            self.comparisons += 1
            if self.group[j] < pivot:
                i += 1
                self.swap(i,j)
                
        self.swap(i+1,last)
        return i+1
    
    def quickSort(self,first,last):
        if first < last:
            pivotIndex = self.partition(first,last)
            self.quickSort(first,pivotIndex-1)
            self.quickSort(pivotIndex+1,last)
        return True
    
    def sort(self):
        self.quickSort(self.first,self.last)
        return [self.group,self.comparisons,self.swaps]

def func(x):
    res = x*np.log(x)
    return res

size = list(range(1,1051,50))

rawResultsSwaps = []
resultsSwaps = []
rawResultsComps = []
resultsComps = []

model = []
raw = 0
"""startTime = tm.time()"""

for quant in size:
    model.append(func(quant))
    group = list(range(quant))
    
    rawResultsSwaps.append([])
    rawResultsComps.append([])
    repeats = 0
    while repeats < 50:
        rn.shuffle(group)
        qSort = QuickSort(group)
        info = qSort.sort()
        
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
    

