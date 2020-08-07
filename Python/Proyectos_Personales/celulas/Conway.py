import matplotlib.image as image
import matplotlib.pyplot as plt
import matplotlib.animation as animation

class Conway():

    def __init__(self,initialCondition):
        self.currentActiveCells = []
        self.initialCondition = self.refineDrawing(image.imread('./initialConditions/'+initialCondition+'.png'))
        self.currentGeneration = self.initialCondition

    def refineDrawing(self,drawing):
        pixels = [[]]
        size = drawing.shape[0]

        i = 0
        while i < size + 2:
            pixels[0].append(0)
            i += 1
        
        i = 0
        while i < size:
            j = 0
            row = [0]

            while j < size:
                if drawing[i][j][3] == 1:
                    row.append(1)
                    self.currentActiveCells.append([i+1,j+1])
                else:
                    row.append(-1)

                j += 1

            i += 1
            row.append(0)
            pixels.append(row)
        
        pixels.append([])

        i = 0
        while i < size + 2:
            pixels[-1].append(0)
            i += 1

        return pixels

    def showGrid(self):
        return plt.imshow(self.currentGeneration,cmap='binary',animated=True)
        #plt.pause(0.05)

    def switchCell(self,positions):
        for pos in positions:
            self.currentGeneration[pos[0]][pos[1]] = -self.currentGeneration[pos[0]][pos[1]]
        self.currentActiveCells = positions
    
    def getNeighbourCells(self,pos):
        n1 = [pos[0] - 1,pos[1] - 1]
        n2 = [pos[0] - 1,pos[1]    ]
        n3 = [pos[0] - 1,pos[1] + 1]
        n4 = [pos[0]    ,pos[1] - 1]
        n5 = [pos[0]    ,pos[1] + 1]
        n6 = [pos[0] + 1,pos[1] - 1]
        n7 = [pos[0] + 1,pos[1]    ]
        n8 = [pos[0] + 1,pos[1] + 1]
        return [n1,n2,n3,n4,n5,n6,n7,n8]
    
    def prepareCurrentGeneration(self):
        toBeChecked = []
        for cell in self.currentActiveCells:
            neighbourCells = self.getNeighbourCells(cell)
            
            for neighbour in neighbourCells:

                isIn = neighbour in toBeChecked
                value = self.currentGeneration[neighbour[0]][neighbour[1]]

                if not isIn and value != 0:
                    toBeChecked.append(neighbour)
            
            if not cell in toBeChecked:
                toBeChecked.append(cell)

        return toBeChecked
    
    def checkCurrentGeneration(self):
        toBeChecked = self.prepareCurrentGeneration()
        nextGeneration = []

        for cell in toBeChecked:
            state = self.currentGeneration[cell[0]][cell[1]]
            localPopulation = 0
            neighbours = self.getNeighbourCells(cell)

            for neighbour in neighbours:
                if self.currentGeneration[neighbour[0]][neighbour[1]] == 1:
                    localPopulation += 1
                    if localPopulation > 3:
                        break
            
            if state == -1 and localPopulation == 3:
                nextGeneration.append(cell)

            elif state == 1 and localPopulation != 2 and localPopulation != 3:
                nextGeneration.append(cell)

        return nextGeneration

    def play(self,steps,name):
        fig = plt.figure()
        #writeGif = animation.PillowWriter(fps=30)
        writeVideo = animation.FFMpegWriter(fps=30)
        ims = []
        plt.gca().axes.get_xaxis().set_visible(False)
        plt.gca().axes.get_yaxis().set_visible(False)
        for i in range(10):
            im = self.showGrid()
            ims.append([im])
        while steps > 0:
            self.switchCell(self.checkCurrentGeneration())
            im = self.showGrid()
            ims.append([im])
            steps -= 1

        ani = animation.ArtistAnimation(fig, ims,interval=200, blit=True, repeat=False)
        #ani.save('./videos/'+name+'.mp4',writer=writeVideo)
        plt.show()


conway = Conway('chaco')
conway.play(100,'R_pentonimo')