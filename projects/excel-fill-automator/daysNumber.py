def daysNumber(year, month): # to see how many days in a specified month
        leap = 0
        if year % 400 == 0:
            leap = 1
        elif year % 100 == 0:
            leap = 0
        elif year % 4 == 0:
            leap = 1
        if month == 2:
            return 28 + leap
        
        list = [1,3,5,7,8,10,12]

        if month in list:
            return 31
        return 30