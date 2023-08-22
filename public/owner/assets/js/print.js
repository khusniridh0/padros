const print = window
print.print()
if (navigator.userAgent.includes('Chrome')) {
    print.addEventListener('afterprint', function () {
        print.close()
    })
}
if (navigator.userAgent.includes('Firefox')) {
    print.close()
}